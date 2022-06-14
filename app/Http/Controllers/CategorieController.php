<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StorecategorieRequest;
use App\Http\Requests\UpdatecategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categorie.index')->with([
            'categories' => Categorie::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategorieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategorieRequest $request)
    {
        $request->validated();
        Categorie::create([
            "id_user" => $request->user()->id,
            "libele" => $request->libele,
            "description" => $request->description,
        ]);
        return redirect()->route('categorie.index')->with('success', 'La catégorie est ajouté avec succès');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategorieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromModal(StorecategorieRequest $request)
    {
        $request->validated();
        $categorie = Categorie::create([
            "id_user" => $request->user()->id,
            "libele" => $request->libele,
            "description" => $request->description,
        ]);
        return $categorie;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(categorie $categorie)
    {
        return view('categorie.edit')->with('categorie', $categorie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategorieRequest  $request
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategorieRequest $request, categorie $categorie)
    {
        $request->validated();
        $categorie->update([
            "id_user" => $request->user()->id,
            "libele" => $request->libele,
            "description" => $request->description
        ]);
        return redirect()->route('categorie.index')->with('success', 'La catégorie est modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route("categorie.index")->with("success", "La catégorie est supperimé avec succès.");
    }
}
