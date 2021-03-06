<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;
use App\Exports\MarquesExport;
use App\Imports\MarquesImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreMarqueRequest;
use App\Http\Requests\UpdateMarqueRequest;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('marque.index')->with([
            'marques' => Marque::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marque.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarqueRequest $request)
    {
        $request->validated();
        $imageName = null;
        if($request->has("image")){
            $file = $request->image;
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$imageName);
        }
        Marque::create([
            "id_user" => $request->user()->id,
            "libele" => $request->libele,
            "logo" => $imageName,
            "description" => $request->description,
        ]);
        return redirect()->route('marque.index')->with('success', 'La marque est ajouté avec succès');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromModal(StoreMarqueRequest $request)
    {
        $request->validated();
        $imageName = null;
        if($request->has("image")){
            $file = $request->image;
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$imageName);
        }
        $marque = Marque::create([
            "id_user" => $request->user()->id,
            "libele" => $request->libele,
            "logo" => $imageName,
            "description" => $request->description,
        ]);
        return $marque;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function show(Marque $marque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function edit(Marque $marque)
    {
        return view('marque.edit')->with('marque', $marque);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarqueRequest  $request
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarqueRequest $request, Marque $marque)
    {
        $request->validated();
        $imageName = null;
        if($request->has("image")){
            if ($marque->logo) {
                $image_path = public_path("uploads\\".$marque->logo);
                if(File::exists($image_path)){
                    unlink($image_path);
                }
            }
            $file = $request->image;
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$imageName);
            $marque->logo = $imageName;
        }
        $marque->update([
            "id_user" => $request->user()->id,
            "libele" => $request->libele,
            "logo" => $marque->logo,
            "description" => $request->description
        ]);
        return redirect()->route('marque.index')->with('success', 'La marque est modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marque $marque)
    {
        if($marque->logo){
            if ($marque->logo) {
                $image_path = public_path("uploads\\".$marque->logo);
                if(File::exists($image_path)){
                    unlink($image_path);
                }
            }
        }
        $marque->delete();
        return redirect()->route("marque.index")->with("success", "La marque est supperimé avec succès.");
    }
    /**
     * Export the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        if ($request->marques) {
            return Excel::download(new MarquesExport($request), 'marques'.time().'.xlsx');
        }
        return redirect()->back()->withErrors(['Aux moin un marque doit etre selectione pour exporter']);
    }
    /**
     * Import the specified resource into storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'importermarques' => 'required|mimes:xlsx,csv',
        ]);
        Excel::import(new MarquesImport($request),$request->file('importermarques'));
        return redirect()->back()->with('success', 'Les marques sont importés avec succès.');
    }
}
