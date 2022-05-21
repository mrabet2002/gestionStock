<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
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
        if($request->validated()){
            $lignesVenteTotal = $this->getLignesVente($request->lignesVente);
            //dd($lignesVenteTotal);
            if (!empty($lignesVenteTotal['lignesVenteValide'])) {
                $date_creation = $request->date_creation ? $request->date_creation : Carbon::now();
                $remiseVente = $request->remiseVente ? $request->remiseVente : 0; 
                $taxe = $request->taxe ? $request->taxe : 0;
                $vente = Vente::create([
                    "id_user" => auth()->user()->id,
                    "id_client" => $request->client,
                    "total" => number_format(($lignesVenteTotal['total']*(1-(double)$remiseVente/100)),2),
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
                /* foreach ($vente->produits as $key => $produit) {
                    $produit->stocks->where('qte')
                } */
            }else {
                return redirect()->back()->withErrors(['Vous devez ajouer au moins une ligne d\'vente'])->withInput($request->input());
            }
                return redirect()->route('vente.index')->with('success', 'Vente ajouter avec succès.');
        }else {
            return redirect()->back()->withInput($request->input());
        }
    }

    public function getLignesVente($lignesVente)
    {
        $lignesVenteValide = [];
        if (isset($lignesVente)) {
            $total = 0;
            foreach ($lignesVente as $key => $ligneAchat) {
                if ($ligneAchat['qte_demandee'] > 0 && $ligneAchat['qte_demandee'] !== null && $ligneAchat['prix'] > 0 && $ligneAchat['prix'] !== null) {
                    $ligneTotal = ($ligneAchat['prix']*$ligneAchat['qte_demandee'])*(1-(double)$ligneAchat['remise']/100);
                    $total += $ligneTotal;
                    $ligneAchat['total'] = number_format((double)$ligneTotal, 2);
                    $lignesVenteValide[$key] = $ligneAchat;
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
        return view('vente.edit')->with([
            'vente' => $vente,
            'clients' => Client::orderBy('name', "asc")->get(),
            'produits' => Produit::orderBy('libele', "asc")->get()
        ]);
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
        //
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

    public function validerVente(Vente $vente)
    {
        
    }
}
