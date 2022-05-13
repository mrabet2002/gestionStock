<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Support\Facades\File;
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
}
