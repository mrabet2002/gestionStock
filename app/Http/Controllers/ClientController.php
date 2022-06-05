<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Exports\ClientsExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index')->with([
            'clients' => Client::orderBy('num_client', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num_client = Client::get()->max('num_client') + 1;
        return view('client.create')->with('num_client', $num_client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $request->validated();
        $fileName = null;
        if($request->has("fichier_attache")){
            $file = $request->fichier_attache;
            $fileName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/"),$fileName);
        }
        try {
            Client::create([
                "id_user" => $request->user()->id,
                "num_client" => $request->num_client,
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
                "statut" => $request->statut,
                "fichier_attacher" => $fileName,
            ]);
            return redirect()->route('client.index')->with('success', 'Le client est ajouté avec succès');
            
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Erreur'])->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.show')->with([
            'client' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit')->with([
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
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
            $client->fichier_attacher = $fileName;
        }
        $client->update([
            "id_user" => $request->user()->id,
            "num_client" => $request->num_client,
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
            'statut' => $request->statut,
            "fichier_attacher" => $client->fichier_attacher,
        ]);
        return redirect()->route('client.show', $client)->with('success', 'Le client est modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if ($client->fichier_attache) {
            $file_path = public_path("uploads\\".$client->fichier_attache);
            if (File::exists($file_path)) {
                unlink($file_path);
            }
        }
        $client->delete();
        return redirect()->route('client.index')->with("success", "Le client est supperimé avec succès.");
    }
    public function export(Request $request)
    {
        if ($request->clients) {
            return Excel::download(new ClientsExport($request), 'clients'.time().'.xlsx');
        }
        return redirect()->back()->withErrors(['Aux moin un client doit etre selectione pour exporter']);
    }
}
