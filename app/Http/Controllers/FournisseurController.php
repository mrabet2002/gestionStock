<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Exports\FournisseursExport;
use App\Imports\FournisseursImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
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
            'fournisseurs' => Fournisseur::orderBy('num_fournisseur','asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num_fournisseur = Fournisseur::get()->max('num_fournisseur') + 1;
        return view('fournisseur.create')->with('num_fournisseur', $num_fournisseur);
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
    }

    public function storeFromModal(StoreFournisseurRequest $request)
    {
        
        $request->validated();
        $fileName = null;
        if($request->has("fichier_attache")){
            $file = $request->fichier_attache;
            $fileName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$fileName);
        }
        $nouveauFournisseur = Fournisseur::create([
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
        return $nouveauFournisseur;
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
            $file_path = public_path('uploads\\'.$request->fichier_attache);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            $file = $request->fichier_attache;
            $fileName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$fileName);
            $fournisseur->fichier_attacher = $fileName;
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
                "fichier_attacher" => $fournisseur->fichier_attacher,
            ]);
            return redirect()->route('fournisseur.index')->with('success', 'Le fournisseur est modifié avec succès');
        } catch (QueryException $query_exception) {
            return redirect()->back()->withErrors(['Le champ du client doit etre unique'])->withInput($request->input());
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
    public function export(Request $request)
    {
        if ($request->fournisseurs) {
            return Excel::download(new FournisseursExport($request), 'fournisseurs'.time().'.xlsx');
        }
        return redirect()->back()->withErrors(['Aux moin un fournisseur doit etre selectione pour exporter']);
    }
    public function import(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'importerfournisseurs' => 'required|mimes:xlsx,csv',
        ]);
        Excel::import(new FournisseursImport($request),$request->file('importerfournisseurs'));
        return redirect()->back()->with('success', 'Les fournisseurs sont importés avec succès.');
    }
}
