<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Client;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facture.index')->with([
            'factures' => Facture::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients_ventes = Vente::where('id_facture', null)->get()->groupBy('id_client');
        $clients = Client::find(array_keys($clients_ventes->toArray()));
        $num_facture = Facture::get()->max('num_facture') + 1;
        return view('facture.create')->with([
            'clients' => $clients,
            'clients_ventes' => $clients_ventes,
            'num_facture' => $num_facture
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactureRequest $request)
    {
        if($request->ventes){

            $ventes = Vente::find($request->ventes);
            $montant_ht = $ventes->sum('total');
            $ttc = $montant_ht*(1 + $request->tva/100);
            $net_payer = $ttc*(1 - $request->remise/100);
            $fileName = null;
            if($request->has("fichier_attache")){
                $file = $request->fichier_attache;
                $fileName = time()."_".$file->getClientOriginalName();
                $file->move(public_path("uploads/"),$fileName);
            }
            $facture = Facture::create([
                "id_user" => $request->user()->id,
                "num_facture" => $request->num_facture,
                "date_echeance" => $request->date_echeance,
                "statut_paiment" => $request->statut_paiment,
                "methode_paiment" => $request->methode_paiment,
                "tva" => $request->tva,
                "remise" => $request->remise,
                "montant_ht" => number_format($montant_ht, 2, ".",""),
                "total_ttc" => number_format($ttc, 2, ".",""),
                "net_payer" => number_format($net_payer, 2, ".",""),
                "description" => $request->description,
                "devise" => $request->devise,
                "fichier_attacher" => $fileName,
            ]);
            $ventes->map(function($vente) use($facture){
                $vente->update([
                    'id_facture' => $facture->id,
                ]);
            });
            return redirect()->route('facture.index')->with('success', 'La facture est ajouté avec succès');
        }else {
            return redirect()->back()->withErrors(['Aucune vente choisie !'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Facture $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        $client = $facture->ventes->first()->client;
        return view('facture.show')->with([
            'facture' => $facture,
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Facture $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        $clients_ventes = Vente::where('id_facture', null)->orWhere('id_facture', $facture->id)->get()->groupBy('id_client');
        $clients = Client::find(array_keys($clients_ventes->toArray()));
        $num_facture = Facture::latest()->first()->num_facture;
        return view('facture.edite')->with([
            'clients' => $clients,
            'clients_ventes' => $clients_ventes,
            'facture' => $facture
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Facture $facture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFactureRequest $request, Facture $facture)
    {
        if($request->ventes){
            $ventes = Vente::find($request->ventes);
            $montant_ht = $ventes->sum('total');
            $ttc = $montant_ht*(1 + $request->tva/100);
            $net_payer = $ttc*(1 - $request->remise/100);
            $fileName = null;
            if($request->has("fichier_attache")){
                $file_path = public_path('uploads\\'.$request->fichier_attache);
                if(File::exists($file_path)){
                    unlink($file_path);
                }
                $file = $request->fichier_attache;
                $fileName = time()."_".$file->getClientOriginalName();
                $file->move(public_path("uploads/"),$fileName);
                $facture->fichier_attacher = $fileName;
            }
            $facture->update([
                "id_user" => $request->user()->id,
                "num_facture" => $request->num_facture,
                "date_echeance" => $request->date_echeance,
                "statut_paiment" => $request->statut_paiment,
                "methode_paiment" => $request->methode_paiment,
                "tva" => $request->tva,
                "remise" => $request->remise,
                "montant_ht" => number_format($montant_ht, 2, ".",""),
                "total_ttc" => number_format($ttc, 2, ".",""),
                "net_payer" => number_format($net_payer, 2, ".",""),
                "description" => $request->description,
                "devise" => $request->devise,
                "fichier_attacher" => $facture->fichier_attacher,
            ]);
            $facture->ventes->whereNotIn('id', $ventes->pluck('id'))->map(function($vente) use($facture){
                $vente->facture()->dissociate($facture)->save();
            });
            $ventes->whereNotIn('id', $facture->ventes->pluck('id'))->map(function($vente) use($facture){
                $vente->facture()->associate($facture)->save();
            });
            return redirect()->route('facture.index')->with('success', 'La facture est modifié avec succès');
        }else {
            return redirect()->back()->withErrors(['Aucune vente choisie !'])->withInput();
        }
    }

    public function validerFactures(Request $request)
    {
        if ($request->factures) {
            $factures = Facture::find($request->factures);
            $factures->map(function($facture){
                if ($facture->statut_paiment == 'non-payee') {
                    $facture->update([
                        'statut_paiment' => 'payee'
                    ]);
                }
            });
            return redirect()->back()->with('success', 'factures valider avec succès');
        }
        return redirect()->back()->withErrors(['Aucune facture sélectionnée !']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Facture $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('facture.index')->with("success", "La facture est supperimé avec succès.");
    }
}
