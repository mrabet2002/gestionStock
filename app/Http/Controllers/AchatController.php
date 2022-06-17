<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Achat;
use App\Models\Stock;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Http\Requests\StoreachatRequest;
use App\Http\Requests\UpdateachatRequest;
use App\Http\Requests\RecevoirProduitsRequest;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('achat.index')->with([
            'achats' => Achat::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('achat.create')->with([
            'fournisseurs' => Fournisseur::all(),
            'produits' => Produit::orderBy('libele', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreachatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreachatRequest $request)
    {
        if($request->validated()){
            $lignesAchatTotal = $this->getLignesAchat($request->lignesAchat, $request->fournisseur);
            if (!empty($lignesAchatTotal['lignesAchatValide'])) {
                $date_creation = $request->date_creation ? $request->date_creation : Carbon::now();
                $remiseAchat = $request->remiseAchat ? $request->remiseAchat : 0; 
                $taxe = $request->taxe ? $request->taxe : 0;
                $total = (($lignesAchatTotal['total']*(1+$taxe/100))*(1-$remiseAchat/100));
                $achat = Achat::create([
                    "id_user" => auth()->user()->id,
                    "id_fournisseur" => $request->fournisseur,
                    "total" => number_format($total,2,".",""),
                    "taxe" => $taxe,
                    "created_at" => $date_creation,
                    "description" => $request->description,
                    "devise" => $request->devise,
                    "remise" => $remiseAchat,
                ]);
                $achat->produits()->sync($lignesAchatTotal['lignesAchatValide']);
            }else {
                return redirect()->back()->withErrors(['Vous devez ajouer au moins une ligne d\'achat'])->withInput($request->input());
            }
                return redirect()->route('achat.index')->with('success', 'Achat ajouter avec succès.');
        }else {
            return redirect()->back()->withInput($request->input());
        }
    }

    public function getLignesAchat($lignesAchat, $fournisseur)
    {
        $lignesAchatValide = [];
        if (isset($lignesAchat)) {
            $total = 0;
            foreach ($lignesAchat as $key => $ligneAchat) {
                if ($ligneAchat['qte_demandee'] > 0 && $ligneAchat['qte_demandee'] !== null && $ligneAchat['prix'] > 0 && $ligneAchat['prix'] !== null) {
                    $ligneTotal = ($ligneAchat['prix']*$ligneAchat['qte_demandee'])*(1-(double)$ligneAchat['remise']/100);
                    $total += $ligneTotal;
                    $ligneAchat['total'] = number_format((double)$ligneTotal, 2,".","");
                    $lignesAchatValide[$key] = $ligneAchat;
                }
            }
            $lignesAchatTotal['lignesAchatValide'] = $lignesAchatValide;
            $lignesAchatTotal['total'] = $total;
        }
        return $lignesAchatTotal;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function show(Achat $achat)
    {
        return view('achat.show')->with([
            'achat' => $achat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function edit(Achat $achat)
    {
        if ($achat->statut != 'Valoriser') {
            return view('achat.edit')->with([
                'achat' => $achat,
                'fournisseurs' => Fournisseur::all(),
                'produits' => Produit::where('id_fournisseur',$achat->id_fournisseur)->get(),
            ]);
        }else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateachatRequest  $request
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateachatRequest $request, Achat $achat)
    {
        if ($achat->statut != 'Valoriser') {
            if($request->validated()){
                $lignesAchatTotal = $this->getLignesAchat($request->lignesAchat, $request->fournisseur);
                if (!empty($lignesAchatTotal['lignesAchatValide'])) {
                    $date_creation = $request->date_creation ? $request->date_creation : Carbon::now();
                    $remiseAchat = $request->remiseAchat ? $request->remiseAchat : 0; 
                    $taxe = $request->taxe ? $request->taxe : 0;
                    $total = (($lignesAchatTotal['total']*(1+$taxe/100))*(1-$remiseAchat/100));
                    $achat->update([
                        "id_user" => auth()->user()->id,
                        "id_fournisseur" => $request->fournisseur,
                        "total" => number_format($total,2,".",""),
                        "taxe" => $taxe,
                        "created_at" => $date_creation,
                        "description" => $request->description,
                        "devise" => $request->devise,
                        "remise" => $remiseAchat,
                    ]);
                    $achat->produits()->sync($lignesAchatTotal['lignesAchatValide']);
                }else {
                    return redirect()->back()->withErrors(['Vous devez ajouer au moins une ligne d\'achat'])->withInput($request->input());
                }
                    return redirect()->route('achat.index')->with('success', 'Achat ajouter avec succès.');
            }else {
                return redirect()->back()->withInput($request->input());
            }
        }else {
            abort(403);
        }
    }

    public function recevoirProduit(RecevoirProduitsRequest $request, Achat $achat)
    {
        if($request->validated()){
            if ($achat->statut == 'En cours') {
                $date_reception = $request->date_reception ? $request->date_reception : Carbon::now();
                $achat->update([
                    'date_reception' => $request->date_reception,
                    'statut' => 'Livrais'
                ]);
                $achat->produits()->sync($request->lignesAchat);
                return redirect()->route('achat.index')->with('success', 'L\'achat est validé avec succes');
            }else if ($achat->statut == 'Livrais') {
                $achat->update([
                    'statut' => 'Valoriser'
                ]);
                $achat->produits()->sync($request->lignesAchat);
                foreach ($achat->produits as $key => $produit) {
                    Stock::create([
                        "id_produit" => $produit->id,
                        "prix_achat" => $produit->pivot->prix,
                        "qte" => $produit->pivot->qte_recu,
                        "qte_disponible" => $produit->pivot->qte_recu,
                        "date_expiration" => $produit->pivot->date_expiration,
                    ]);
                }
                return redirect()->route('achat.index')->with('success', 'L\'achat est valorisé avec succes');
            }else{
                return redirect()->back()->withErrors(['Vous pouvais pas fair cette action.'])->withInput($request->input());
            }
        }else {
            return redirect()->back()->withInput($request->input());
        }
    }

    public function valoriser(Achat $achat)
    {
        if ($achat->statut == 'Livrais') {
            $achat->update([
                'statut' => 'Valoriser'
            ]);
            foreach ($achat->produits as $key => $produit) {
                Stock::create([
                    "id_produit" => $produit->id,
                    "prix_achat" => $produit->pivot->prix,
                    "qte" => $produit->pivot->qte_recu,
                    "qte_disponible" => $produit->pivot->qte_recu,
                    "date_expiration" => $produit->pivot->date_expiration,
                ]);
            }
            return redirect()->route('achat.index')->with('success', 'L\'achat modifier avec succes');
        }else{
            return redirect()->back()->withErrors(['Vous pouvais pas fair cette action.'])->withInput($request->input());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achat $achat)
    {
        $achat->delete();
        return redirect()->route('achat.index')->with("success", "L'achat est annulé avec succès.");
    }
}
