<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __("Modifier la facture num ".$facture->num_facture) }}
                </div>
                <div class="py-1">
                        <button data-modal-toggle="annulerFormModal" type="button" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo transition" >
                            <span class="mr-3">
                                Annuler
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </button>
                        <button type="submit" form="factureData" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo active:bg-gray-50 transition">
                            <span class="mr-3">
                                Enregistrer
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                            </svg>
                        </button>
                    
                </div>
            </div>
        </div>
    </x-slot>
    @section('content')
        <!-- Annuler Formulaire Modal -->
        <div id="annulerFormModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-200 md:inset-0 h-full md:h-full">
            <div class="relative modal-container w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-3/4">
                    <!-- Modal header -->
                    <div class="flex justify-end p-2">
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-2 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="annulerFormModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 pt-0 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Votre travail ne sera pas enregistré. Êtes-vous sûr de vouloir continuer ?
                        </h3>
                        <a href="{{route('facture.index')}}" type="button" class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                            Oui, je suis sur
                        </a>
                        <button data-modal-toggle="annulerFormModal" type="button" class="mt-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Non, rester sur ce formulaire
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert-container">
                @foreach ($errors->all() as $error)
                    <div class="alert bg-red-100 border px-3 py-3 rounded-lg" role="alert">
                        <svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="px-3">{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif
            <div class="containerc">
                <form action="{{route('facture.update', $facture->id)}}" method="POST" enctype="multipart/form-data" id="factureData">
                    @csrf
                    <div class="sm:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-2 overflow-hidden">
                            <div class="card shadow-md h-fit">
                                <div class="flex justify-start p-6 card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                                    </div>
                                </div><hr>
                                <div class="mt-5 md:mt-0 card-body">
                                    <div class="grid grid-cols-6 gap-6">                     
                                        <div class="col-span-6">
                                            <label for="num_facture" class="block text-sm font-medium text-gray-700">Num facture</label>
                                            <input type="number" step="0.01" name="num_facture" id="num_facture" value="{{old('num_facture') ? old('num_facture') : $facture->num_facture}}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6">
                                            <label for="date_echeance" class="block text-sm font-medium text-gray-700">Date d'échéance</label>
                                            <input type="date" step="0.01" name="date_echeance" id="date_echeance" 
                                            value="{{old('date_echeance') ? old('date_echeance') : (new DateTime())->format('Y-m-d')}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        
                                        <div class="col-span-6 ">
                                            <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                                            <div class="mt-1">
                                                <textarea id="description" name="description" rows="6" class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">
                                                    {{old('description') ? old('description') : $facture->description}}
                                                </textarea>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Description brève de la facture.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="card shadow-md">
                                <div class="flex justify-start card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Plus de détails</h3>
                                    </div>
                                </div><hr>
                                <div class="mt-5 md:mt-0 card-body">
                                    <div class="grid grid-cols-6 gap-6">
                
                                        <div class="col-span-6">
                                            <label for="remise" class="block text-sm font-medium text-gray-700"> Remise Globale </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                <input type="number" name="remise" id="remise" value="{{old('remise') ? old('remise') : $facture->remise}}" 
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="devise" class="block text-sm font-medium text-gray-700">Devise</label>
                                            <input type="text" name="devise" id="devise" value="{{old('devise') ? old('devise') : $facture->devise}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="tva" class="block text-sm font-medium text-gray-700">TVA</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                <input type="number" step="0.01" name="tva" id="tva" value="{{old('tva') ? old('tva') : $facture->tva}}" 
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-2 px-4">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Paiment</h3>
                                </div><hr>
                                <div class="card-body">
                                    <div class="col-span-6">
                                        <label for="statut_paiment" class="block text-sm font-medium text-gray-700">Statut</label>
                                        <select id="statut_paiment" name="statut_paiment" 
                                        class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option disabled>Selectionner un statut</option>
                                            <option value="payee" {{old('statut_paiment') ? (old('statut_paiment') == "payee" ? "selected" : "") : ($facture->statut_paiment == "payee" ? "selected" : "")}}>
                                                Payée
                                            </option>
                                            <option value="non-payee" {{old('statut_paiment') ? (old('statut_paiment') == "non-payee" ? "selected" : "") : ($facture->statut_paiment == "non-payee" ? "selected" : "")}}>
                                                Non payée
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 mt-2">
                                        <label for="methode_paiment" class="block text-sm font-medium text-gray-700">Méthode de paiment</label>
                                        <select id="methode_paiment" name="methode_paiment" 
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option selected disabled>Selectionner une méhode de paiment</option>
                                            <option value="espece" {{old('methode_paiment') ? (old('methode_paiment') == "espece" ? "selected" : "") : ($facture->methode_paiment == "espece" ? "selected" : "")}}>
                                                Espèces
                                            </option>
                                            <option value="cheque" {{old('methode_paiment') ? (old('methode_paiment') == "cheque" ? "selected" : "") : ($facture->methode_paiment == "cheque" ? "selected" : "")}}>
                                                Chèque
                                            </option>
                                            <option value="carte_credit" {{old('methode_paiment') ? (old('methode_paiment') == "carte_credit" ? "selected" : "") : ($facture->methode_paiment == "carte_credit" ? "selected" : "")}}>
                                                Cartes de crédit
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6 card">
                                <div class="card-head">
                                    <h3 class="text-lg font-bold leading-6 text-gray-900">Fichier attaché</h3>
                                </div><hr>
                                <div class="card-body">
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        
                                        <div class="flex text-sm text-gray-600">
                                            <label for="fichier_attache" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <div class="px-6">
                                                    <span>Choisisser un fichier</span>
                                                    <img class="Image-preview mx-auto" style="display: none;" src="" width="50%" alt="Image preview...">
                                                    <p class="pdf-preview text-gray-500" style="display: none;"></p>
                                                </div>
                                                <input id="fichier_attache" name="fichier_attache" type="file" class="file-input sr-only" onchange="previewFile(true)">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="card shadow-md">
                                <div class="flex justify-start card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Lignes de ventes</h3>
                                    </div>
                                </div><hr>
                                <div class="card-body relative">
                                    <div class="py-6">
                                        <label for="table-search">Choisir un clien</label>
                                        <div class="md:grid md:grid-cols-3 gap-6">
                                            <div class="flex justify-between">
                                                <select id="client" name="client" required
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                onchange="filtreVentesParClient(event)">
                                                    <option selected disabled value="">Selectionner un client</option>
                                                    @if ($clients->count() == 0)
                                                        <option disabled>Désolés, nous ne trouvant pas de clients</option>
                                                    @else
                                                        @foreach ($clients as $client)
                                                            <option adresse="{{$client->adresse}}" devise="{{$client->devise}}" value="{{$client->id}}" {{old('client') ? (old('client') == $client->id ? "selected" : "") : ($facture->ventes()->where('id_client', $client->id)->exists() ? "selected" : "")}}>
                                                                {{$client->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-white uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="py-4 px-4">
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    ID
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Date de creation
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Date de livraison
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Total
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Statut
                                                </th>
                                            </tr>
                                        </thead>
                                        
                                            @if ($clients_ventes->count() > 0)
                                                @foreach ($clients_ventes as $id_client => $ventes)
                                                <tbody id="tbody_{{$id_client}}" class="{{old('client') ? (old('client') != $id_client ? 'hidden' : "") : (!$facture->ventes()->where('id_client', $id_client)->exists() ? 'hidden' : "")}}">
                                                    <tr id="row_{{$id_client}}" class="cursor-pointer bg-gray-200 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                        <td class="w-4 px-4">
                                                            <div class="flex items-center">
                                                                <input form="validerVentes" id="checkbox_row_{{$id_client}}" value="{{$id_client}}" name="clients[{{$id_client}}][checked]" type="checkbox" 
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                                onclick="checkAllGroupToggel(event)">
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 text-gray-800 font-bold" colspan="8">
                                                            {{$clients->find($id_client)->name}}
                                                        </td>
                                                        
                                                        @foreach ($ventes as $vente)
                                                            <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                                <td class="w-4 px-4">
                                                                    <div class="flex items-center">
                                                                        <input {{$vente->id_facture == $facture->id ? 'checked' : ''}} id="{{$vente->id}}" value="{{$vente->id}}" name="ventes[{{$vente->id}}]" type="checkbox" class="checkbox_row_{{$id_client}} w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                    </div>
                                                                </td>
                                                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                                    {{$vente->id}}
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    {{$vente->created_at->format('d-m-Y')}}
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    {{$vente->date_livraison}}
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    {{$vente->total}}
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    @switch($vente->statut)
                                                                        @case('Éditer')
                                                                            <div class="bg-orange-500 font-bold py-1 px-3 rounded text-white text-center" style="width: fit-content">
                                                                                Éditer
                                                                            </div>
                                                                            @break
                                                                        @case('Valider')
                                                                            <div class="bg-green-500 font-bold py-1 px-3 rounded text-white text-center" style="width: fit-content">
                                                                                Valider
                                                                            </div>
                                                                            @break
                                                                        @default
                                                                            
                                                                    @endswitch
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            @else
                                                <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <td class="px-6 py-4 text-center" colspan="9">
                                                        <h4 class="py-3 text-md font-bold">Aucune vente trouvé, cliquez sur le boutant ci-dessous pour créer un.</h4>
                                                    </td>
                                                </tr>
                                            @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    @endsection
    @section('script')
        <script src="/js/script.js"></script>
    @endsection
</x-app-layout>