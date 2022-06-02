<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\produit;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreproduitRequest;
use App\Http\Requests\UpdateproduitRequest;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produit.index')->with([
            'produits' => Produit::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produit.create')->with([
            'fournisseurs' => Fournisseur::all(),
            'categories' => Categorie::all(),
            'marques' => Marque::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproduitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreproduitRequest $request)
    {
        $request->validated();
        $imageName = null;
        if($request->has("image")){
            $file = $request->image;
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$imageName);
        }
        try {
            Produit::create([
                "id_categorie" => $request->categorie,
                "id_marque" => $request->marque,
                "id_fournisseur" => $request->fournisseur,
                "id_user" => $request->user()->id,
                "libele" => $request->libele,
                "image" => $imageName,
                "code_barre" => $request->code_barre,
                "description" => $request->description,
                "min_stock" => $request->min_stock,
                "prix_initial" => $request->prix_initial,
                "poids" => $request->poids,
                "unite" => $request->unite,
                "zone" => $request->zone,
            ]);
            return redirect()->route('produit.index')->with('success', 'Le produit est ajouté avec succès');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Erreur']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(produit $produit)
    {
        return view('produit.show')->with([
            'produit' => $produit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(produit $produit)
    {
        return view('produit.edit')->with([
            'produit' => $produit,
            'fournisseurs' => Fournisseur::all(),
            'categories' => Categorie::all(),
            'marques' => Marque::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproduitRequest  $request
     * @param  \App\Models\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateproduitRequest $request, produit $produit)
    {
        //
        $request->validated();
        $imageName = null;
        if($request->has("image")){
            if ($produit->image) {
                $image_path = public_path("uploads\\".$produit->image);
                if(File::exists($image_path)){
                    unlink($image_path);
                }
            }
            $file = $request->image;
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$imageName);
            $produit->image = $imageName;
        }
        try {
            $produit->update([
                "id_categorie" => $request->categorie,
                "id_marque" => $request->marque,
                "id_fournisseur" => $request->fournisseur,
                "id_user" => $request->user()->id,
                "libele" => $request->libele,
                "image" => $produit->image,
                "code_barre" => $request->code_barre,
                "description" => $request->description,
                "min_stock" => $request->min_stock,
                "prix_initial" => $request->prix_initial,
                "poids" => $request->poids,
                "unite" => $request->unite,
                "zone" => $request->zone,
            ]);
            return redirect()->route('produit.index')->with('success', 'Le produit est modifié avec succès');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Erreur']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(produit $produit)
    {
        if ($produit->image) {
            $image_path = public_path("storage\\images\\products\\".$produit->image);
            if(File::exists($image_path)){
                unlink($image_path);
            } 
        }
        try {
            $produit->delete();
            return redirect()->route("produit.index")->with("success", "Le produit est supperimé avec succès.");
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Erreur']);
        }
    }
}
