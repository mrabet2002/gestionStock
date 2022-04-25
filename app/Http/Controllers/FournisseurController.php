<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Http\Requests\StoreFournisseurRequest;
use App\Http\Requests\UpdateFournisseurRequest;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fournisseur.index')->with([
            'fournisseurs' => Fournisseur::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fournisseur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFournisseurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFournisseurRequest $request)
    {
        $request->validated();
        $fileName = null;
        if($request->has("fichier_attache")){
            $file = $request->fichier_attache;
            $fileName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$fileName);
        }
        try {
            Fournisseur::create([
                "id_user" => $request->user()->id,
                "num_fournisseur" => $request->num_fournisseur,
                "name" => $request->nom,
                "email" => $request->email,
                "tel" => $request->tel,
                "site_web" => $request->site_web,
                "adresse" => $request->adresse,
                "code_postal" => $request->code_postal,
                "pays" => $request->pays,
                "ville" => $request->ville,
                "description" => $request->description,
                "devise" => $request->devise,
                "fichier_attacher" => $fileName,
            ]);
            return redirect()->route('fournisseur.index')->with('success', 'Le fournisseur est ajouté avec succès');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Erreur']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFournisseurRequest  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFournisseurRequest $request, Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        //
    }
}
