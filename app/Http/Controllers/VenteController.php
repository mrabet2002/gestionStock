<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVenteRequest;
use App\Http\Requests\UpdateVenteRequest;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vente.index')->with([
            'ventes' => Vente::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vente.create')->with([
            'clients' => Client::orderBy('name', "asc")->get(),
            'produits' => Produit::orderBy('libele', "asc")->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVenteRequest $request)
    {
        $lignesVenteTotal = $this->getLignesVente($request->lignesVente);
        //dd($lignesVenteTotal);
        if (!empty($lignesVenteTotal['lignesVenteValide'])) {
            $date_creation = $request->date_creation ? $request->date_creation : Carbon::now();
            $remiseVente = $request->remiseVente ? $request->remiseVente : 0; 
            $taxe = $request->taxe ? $request->taxe : 0;
            $cout_livraison = $request->cout_livraison ? $request->cout_livraison : 0;
            $total = (($lignesVenteTotal['total']*(1+$taxe/100))*(1-$remiseVente/100))+$cout_livraison;
            $vente = Vente::create([
                "id_user" => auth()->user()->id,
                "id_client" => $request->client,
                "total" => number_format($total, 2, ".",""),
                "taxe" => $taxe,
                "created_at" => $date_creation,
                "description" => $request->description,
                "devise" => $request->devise,
                "statut" => "Éditer",
                "remise" => $remiseVente,
                "cout_livraison" => $request->cout_livraison,
                "adresse_livraison" => $request->adresse_livraison
            ]);
            $vente->produits()->sync($lignesVenteTotal['lignesVenteValide']);
            
            foreach ($vente->produits as $produit) {
                if($created_at = $produit->stocks->where('qte_disponible', '>=', $produit->pivot->qte_demandee)->min('created_at')){
                    $stock = $produit->stocks->where('created_at', $created_at)->first();
                    $stock->update([
                        'qte_disponible' => $stock->qte_disponible - $produit->pivot->qte_demandee
                    ]);
                    $ligneVente[$produit->id]['qte_livrai'] = $produit->pivot->qte_demandee;
                    $vente->stocks()->attach($stock->id);
                }else if($created_at = $produit->stocks->where('qte_disponible', '>', '0')->min('created_at')){
                    $stock = $produit->stocks->where('created_at', $created_at)->first();
                    $ligneVente[$produit->id]['qte_livrai'] = $stock->qte_disponible;
                    $vente->stocks()->attach($stock->id);
                    $stock->update([
                        'qte_disponible' => 0
                    ]);
                }else{
                    $ligneVente[$produit->id]['qte_livrai'] = 0;
                }
            }
            $vente->produits()->sync($ligneVente);
        }else {
            return redirect()->back()->withErrors(['Vous devez ajouer au moins une ligne d\'vente'])->withInput($request->input());
        }
        return redirect()->route('vente.index')->with('success', 'Vente ajouter avec succès.');
    }

    public function getLignesVente($lignesVente)
    {
        $lignesVenteTotal = [];
        if (isset($lignesVente)) {
            $lignesVenteValide = [];
            $total = 0;
            foreach ($lignesVente as $key => $ligneVente) {
                if ($ligneVente['qte_demandee'] > 0 && $ligneVente['qte_demandee'] !== null && $ligneVente['prix'] > 0 && $ligneVente['prix'] !== null) {
                    
                    $ligneTotal = ($ligneVente['prix']*$ligneVente['qte_demandee'])*(1-$ligneVente['remise']/100);
                    $total += $ligneTotal;
                    $ligneVente['total'] = number_format($ligneTotal, 2, ".","");
                    $lignesVenteValide[$key] = $ligneVente;
                }
            }
            $lignesVenteTotal['lignesVenteValide'] = $lignesVenteValide;
            $lignesVenteTotal['total'] = $total;
        }
        return $lignesVenteTotal;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function show(Vente $vente)
    {
        return view('vente.show')->with([
            'vente' => $vente
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function edit(Vente $vente)
    {
        if ($vente->statut != 'Valider') {
            return view('vente.edit')->with([
                'vente' => $vente,
                'clients' => Client::orderBy('name', "asc")->get(),
                'produits' => Produit::orderBy('libele', "asc")->get()
            ]);
        }else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVenteRequest  $request
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVenteRequest $request, Vente $vente)
    {
        if ($vente->statut != 'Valider') {
            $lignesVenteTotal = $this->getLignesVente($request->lignesVente);
            if (!empty($lignesVenteTotal['lignesVenteValide'])) {
                //Reinitialisation des stock a ces valeur avant la creation du vente
                $vente->produits->map(function($produit) use($vente){
                    if($stockt = $vente->stocks->find($produit->stocks->pluck('id'))->first()){
                        $stockt->update([
                            'qte_disponible' => ($stockt->qte_disponible + $produit->pivot->qte_livrai),
                        ]);
                        $vente->stocks()->detach($stockt->id);
                    }
                });
                $date_creation = $request->date_creation ? $request->date_creation : Carbon::now();
                $remiseVente = $request->remiseVente ? $request->remiseVente : 0; 
                $taxe = $request->taxe ? $request->taxe : 0;
                $cout_livraison = $request->cout_livraison ? $request->cout_livraison : 0;
                $total = (($lignesVenteTotal['total']*(1+$taxe/100))*(1-$remiseVente/100))+$cout_livraison;
                $vente->update([
                    "id_user" => auth()->user()->id,
                    "id_client" => $request->client,
                    "total" => number_format($total, 2, ".",""),
                    "taxe" => $taxe,
                    "created_at" => $date_creation,
                    "description" => $request->description,
                    "devise" => $request->devise,
                    "remise" => $remiseVente,
                    "cout_livraison" => $request->cout_livraison,
                    "adresse_livraison" => $request->adresse_livraison
                ]);
                $vente->produits()->sync($lignesVenteTotal['lignesVenteValide']);
            }else {
                return redirect()->back()->withErrors(['Vous devez ajouer au moins une ligne d\'vente'])->withInput($request->input());
            }
            return redirect()->route('vente.gererStock', $vente->id);
        }else {
            abort(403);
        }
    }

    public function gererStock(Vente $vente)
    {
        if ($vente->statut != 'Valider' && !$vente->stocks()->exists()) {
            foreach ($vente->produits as $produit) {
                if($created_at = $produit->stocks->where('qte_disponible', '>=', $produit->pivot->qte_demandee)->min('created_at')){
                    $stock = $produit->stocks->where('created_at', $created_at)->first();
                    //dd($stock);
                    $stock->update([
                        'qte_disponible' => $stock->qte_disponible - $produit->pivot->qte_demandee
                    ]);
                    $ligneVente[$produit->id]['qte_livrai'] = $produit->pivot->qte_demandee;
                    $vente->stocks()->attach($stock->id);
                }else if($created_at = $produit->stocks->where('qte_disponible', '>', '0')->min('created_at')){
                    $stock = $produit->stocks->where('created_at', $created_at)->first();
                    $ligneVente[$produit->id]['qte_livrai'] = $stock->qte_disponible;
                    $vente->stocks()->attach($stock->id);
                    $stock->update([
                        'qte_disponible' => 0
                    ]);
                }else{
                    $ligneVente[$produit->id]['qte_livrai'] = 0;
                }
            }
            $vente->produits()->sync($ligneVente);
            return redirect()->route('vente.index')->with('success', 'Vente ajouter avec succès.');
        }else {
            abort(403);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vente $vente)
    {
        //
    }

    public function validerVente(Request $request, Vente $vente)
    {
        foreach ($vente->produits  as $produit) {
            $stock = $vente->stocks->find($produit->stocks->pluck('id'))->first();
            $stock->update([
                'qte' => ($stock->qte - $produit->pivot->qte_livrai),
            ]);
        }
        $vente->update([
            'statut' => 'Valider',
            'date_livraison' => $request->date_livraison
        ]);
        return redirect()->back()->with('success', 'Vente valider avec succès');
    }
    
    public function validerVentes(Request $request)
    {
        $ventes = collect($request->ventes);
        $ventes = Vente::find($ventes->pluck('checked'));
        if (!empty($ventes->toArray())) {
            $ventes->map(function($vente) use($request){
                if ($vente->statut != 'Valider') {
                    foreach ($vente->produits  as $produit) {
                        $stock = $vente->stocks->find($produit->stocks->pluck('id'))->first();
                        $stock->update([
                            'qte' => ($stock->qte - $produit->pivot->qte_livrai),
                        ]);
                    }
                    $vente->update([
                        'statut' => 'Valider',
                        'date_livraison' => $request->ventes[$vente->id]['date_livraison']
                    ]);
                }
            });
            return redirect()->back()->with('success', 'Ventes valider avec succès');
        }
        return redirect()->back()->withErrors(['Aucune vente sélectionnée !']);
    }
}
