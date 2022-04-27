<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Support\Facades\File;
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
            'fournisseurs' => Fournisseur::orderBy('updated_at','DESC')->get(),
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
            if ($request->route()->name('produit.fournisseur.store')) {
                return redirect()->back()->withInput();
            }else {
                return redirect()->route('fournisseur.index')->with('success', 'Le fournisseur est ajouté avec succès');
            }
            
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
        return view('fournisseur.show')->with([
            'fournisseur' => $fournisseur,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseur.edit')->with([
            'fournisseur' => $fournisseur,
        ]);
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
        $request->validated();
        if($request->has("fichier_attache")){
            $file_path = public_path('uploads/'.$fournisseur->fichier_attache);
            if(File::exists($file_path)){
                unlink($file_path0);
            }
            $file = $request->fichier_attache;
            $fileName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$fileName);
            $fournisseur->fichier_attache = $fileName;
        }
        try {
            $fournisseur->update([
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
                "fichier_attacher" => $fournisseur->fichier_attache,
            ]);
            return redirect()->route('fournisseur.index')->with('success', 'Le fournisseur est modifié avec succès');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Erreur']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        if ($fournisseur->fichier_attache) {
            $file_path = public_path("uploads\\".$fournisseur->fichier_attache);
            if (File::exists($file_path)) {
                unlink($file_path);
            }
        }
        
        try {
            $fournisseur->delete();
            return redirect()->route('fournisseur.index')->with("success", "Le fournisseur est supperimé avec succès.");
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Erreur']);
        }
    }
}
