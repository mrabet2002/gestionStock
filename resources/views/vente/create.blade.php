<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __("Créer une vente") }}
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
                    <button type="submit" form="venteData" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo active:bg-gray-50 transition">
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
        <div id="annulerFormModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-300 md:inset-0 h-full md:h-full">
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
                        <a href="{{route('vente.index')}}" type="button" class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
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
                <form action="{{route('vente.store')}}" method="POST" enctype="multipart/form-data" id="venteData">
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
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="client" class="w-full block text-sm font-medium text-gray-700">Client</label>
                                            <div class="flex justify-between">
                                                <select id="client" name="client" 
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                onchange="defaultProperties(event)">
                                                    <option selected disabled>Selectionner un client</option>
                                                    @if ($clients->count() == 0)
                                                        <option disabled>Désolés, nous ne trouvant pas de clients</option>
                                                    @else
                                                        @foreach ($clients as $client)
                                                            <option adresse="{{$client->adresse}}" devise="{{$client->devise}}" value="{{$client->id}}" {{$client->id == old('client') ? "selected" : ""}}>
                                                                {{$client->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="px-3">
                                                    <a data-modal-toggle="ajouterClientModal" style="margin-top: 10px" type="button" class="btn btn-indigo transition">
                                                        
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>                     
                                        
                                        <div class="col-span-6 ">
                                            <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                                            <div class="mt-1">
                                                <textarea id="description" name="description" rows="6" class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">
                                                    {{old('description')}}
                                                </textarea>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Description brève de la vente.</p>
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
                                            <label for="date_creation" class="block text-sm font-medium text-gray-700">Date de création</label>
                                            <input type="date" step="0.01" name="date_creation" id="date_creation" 
                                            value="{{old('date_creation') ? old('date_creation') : (new DateTime())->format('Y-m-d')}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <p class="mt-2 text-sm text-gray-500">Si aucune date n'est indiquée, la date du jour est prise par défaut.</p>
                                        </div>
                
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="remiseVente" class="block text-sm font-medium text-gray-700"> Remise Globale </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                <input type="number" name="remiseVente" id="remiseVente" value="{{old('remiseVente') ? old('remiseVente') : 0}}" 
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                onkeyup="calculerTaxeRemise('taxe', 'remiseVente')"
                                                onclick="resetValue(event)">
                                            </div>
                                        </div>
                
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="taxe" class="block text-sm font-medium text-gray-700">Taxe</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                <input type="number" step="0.01" name="taxe" id="taxe" value="{{old('taxe') ? old('taxe') : 0}}" 
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                onkeyup="calculerTaxeRemise('taxe', 'remiseVente')"
                                                onclick="resetValue(event)">
                                            </div>
                                        </div>

                                        <div class="col-span-6">
                                            <label for="devise" class="block text-sm font-medium text-gray-700">Devise</label>
                                            <input type="text" name="devise" id="devise" value="{{old('devise')}}" 
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-start card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Livraison</h3>
                                    </div>
                                </div><hr>
                                <div class="mt-5 md:mt-0 card-body">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="cout_livraison" class="block text-sm font-medium text-gray-700">Coût de livraison</label>
                                            <input type="number" step="0.01" name="cout_livraison" id="cout_livraison" value="{{old('cout_livraison')}}" 
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="adresse_livraison" class="block text-sm font-medium text-gray-700">Adresse de livraison</label>
                                            <input type="text" name="adresse_livraison" id="adresse_livraison" value="{{old('adresse_livraison')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                                    <label for="table-search">Search</label>
                                    <div class="md:grid md:grid-cols-2 gap-6">
                                        <div class="flex">
                                            <div class="relative mt-1">
                                                <input type="text" id="table-search" value="" 
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                placeholder="Search for items"
                                                onkeyup="chercherLigne(event, 'table-produits-body', 0)">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="md:grid md:grid-cols-3 gap-4">
                                        <div class="relative">
                                            <div 
                                                ondragenter="SourceDragEnter(event)"
                                                ondragover="SourceDragOver(event)"
                                                ondragleave="SourceDragLeave(event)"
                                                ondrop="SourceDrop(event)" id="source-zone-top" style="height: 300px" class="absolute block z-50 w-full hidden ronded-md flex items-center opacity-75 justify-center bottom-0 right-0 cursor-pointer bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <h4 class="py-3 text-md font-bold">Ajouter un produit ici.</h4>
                                            </div>
                                            <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-white uppercase bg-blue-500 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr class="block relative">
                                                        <th scope="col" class="px-6 py-4 w-1/2">
                                                            <div class="flex justify-between">
                                                                <div class="flex align-center">
                                                                    Produits
                                                                </div>
                                                                <div class="cursor-pointer rounded ordre-icone transition">
                                                                    <svg onclick="trierString(event, 0, 'table-produits-body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col" class="px-6 py-4">
                                                            <div class="flex justify-between">
                                                                <div class="flex align-center">
                                                                    Quantité en stock
                                                                </div>
                                                                <div class="cursor-pointer rounded ordre-icone transition">
                                                                    <svg onclick="trierNum(event, 6, 'table-produits-body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                                        <path onclick="trierNum(event, 6, 'table-produits-body')" ordre="desc" fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody  class="border border-gray-500 border-2 block table-produits-body" id="source-zone" style="height: 300px; overflow: auto"
                                                ondragenter="SourceDragEnter(event)"
                                                ondragover="SourceDragOver(event)">
                                                    @foreach ($produits as $produit)
                                                        <tr draggable="true" id="produit-{{$produit->id}}" 
                                                            class="cursor-pointer flex justify-between align-center w-full bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                                            ondragstart="dragStart(event)"
                                                            ondragend="dragEnd(event)">
                                                            <td class="produitCell px-6 py-4 font-medium text-gray-900 dark:text-white w-1/4">
                                                                <div class="mt-1 flex">
                                                                    {{$produit->libele}}
                                                                </div>
                                                            </td>
                                                            <td class="prixCell px-2 py-4 hidden" style="width: 15%">
                                                                <div class="mt-1 flex">
                                                                    <input type="number" step="0.01" name="" 
                                                                    value="{{$produit->prix_initial}}" 
                                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                                    onkeyup="calculatTotal(event, 'table-lignesvente-body', 'remiseVente')">
                                                                </div>
                                                            </td>
                                                            <td class="px-2 py-4 hidden" style="width: 15%">
                                                                <div class="mt-1 flex">
                                                                    <input type="number" name="" 
                                                                    value="0" 
                                                                    class="qte-input focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                                    onkeyup="calculatTotal(event, 'table-lignesvente-body', 'remiseVente')"
                                                                    onclick="resetValue(event)">
                                                                </div>
                                                            </td>
                                                            <td class="px-2 py-4 hidden" style="width: 15%">
                                                                <div class="mt-1 flex">
                                                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                                    <input type="number" name="" 
                                                                    value="0" 
                                                                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                                    onkeyup="calculatTotal(event, 'table-lignesvente-body', 'remiseVente')"
                                                                    onclick="resetValue(event)">
                                                                </div>
                                                            </td>
                                                            <td class="px-2 py-4 hidden" style="width: 15%" id="total-input">
                                                                <div class="mt-1 flex">
                                                                    <input type="number" step="0.01" name="" value="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                                @if ($produit->stocks->where('id_produit', $produit->id)->sum('qte_disponible') > 0)
                                                                    @php
                                                                        $color = 'green'
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $color = 'red'
                                                                    @endphp
                                                                @endif
                                                                <div class="cursor-pointer bg-{{$color}}-500 hover:bg-{{$color}}-600 shadow font-bold py-1 px-3 rounded text-white transition">
                                                                    {{$produit->stocks->where('id_produit', $produit->id)->sum('qte_disponible')}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-span-2 relative">
                                            <div 
                                                ondragenter="dragEnter(event)"
                                                ondragover="dragOver(event)"
                                                ondragleave="dragLeave(event)"
                                                ondrop="drop(event)" id="drop-zone-top" style="height: 300px" class="absolute block z-50 w-full hidden ronded-md flex items-center opacity-75 justify-center bottom-0 right-0 cursor-pointer bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <h4 class="py-3 text-md font-bold">Ajouter un produit ici.</h4>
                                            </div>
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
                                                <thead class="text-xs text-white uppercase bg-blue-500 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr class="block relative px-6 flex justify-between">
                                                        <th scope="col" class="px-6 py-6" style="width: 20%">
                                                            Produit
                                                        </th>
                                                        <th scope="col" class="px-6 py-6" style="width: 15%">
                                                            Prix
                                                        </th>
                                                        <th scope="col" class="px-6 py-6" style="width: 15%">
                                                            Qté
                                                        </th>
                                                        <th scope="col" class="px-6 py-6" style="width: 15%">
                                                            Remise
                                                        </th>
                                                        <th scope="col" class="px-6 py-6" style="width: 15%">
                                                            Total
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-lignesvente-body block border border-blue-500 border-2" style="height: 300px; overflow: auto" id="drop-zone"
                                                ondragenter="dragEnter(event)"
                                                ondragover="dragOver(event)">
                                                    @if (old('lignesVente'))
                                                        @foreach (old('lignesVente') as $key => $value)
                                                            <tr draggable="true" id="ligneVente-{{$key}}" 
                                                            class="cursor-pointer flex justify-between align-center w-full bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                                            ondragstart="dragStart(event)"
                                                            ondragend="dragEnd(event)">
                                                                <td class="produitCell px-6 py-4 font-medium text-gray-900 dark:text-white w-1/4">
                                                                    <div class="mt-1 flex">
                                                                        {{$produits->where('id', $key)->first()->libele}}
                                                                    </div>
                                                                </td>
                                                                <td class="prixCell px-2 py-4" style="width: 15%">
                                                                    <div class="col-span-6">
                                                                        <input type="number" step="0.01" name="lignesVente[{{$key}}][prix]" value="{{old('lignesVente.'.$key.'.prix')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                                        onkeyup="calculatTotal(event, 'table-lignesvente-body', 'remiseVente')">
                                                                    </div>
                                                                </td>
                                                                <td class="px-2 py-4" style="width: 15%">
                                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                                        <input type="number" name="lignesVente[{{$key}}][qte_demandee]" value="{{old('lignesVente.'.$key.'.qte_demandee')}}" class="qte-input focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                                        onkeyup="calculatTotal(event, 'table-lignesvente-body', 'remiseVente')"
                                                                        onclick="resetValue(event)">
                                                                    </div>
                                                                </td>
                                                                <td class="px-2 py-4" style="width: 15%">
                                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                                        <input type="number" name="lignesVente[{{$key}}][remise]" value="{{old('lignesVente.'.$key.'.remise')}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                                        onkeyup="calculatTotal(event, 'table-lignesvente-body', 'remiseVente')"
                                                                        onclick="resetValue(event)">
                                                                    </div>
                                                                </td>
                                                                <td class="px-2 py-4" style="width: 15%" id="total-input">
                                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                                        <input type="number" step="0.01" name="lignesVente[{{$key}}][total]" value="{{old('lignesVente.'.$key.'.total')}}" class="total-input focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white hidden">
                                                                    @if ($produit->stocks->where('id_produit', $produit->id)->sum('qte_disponible') > 0)
                                                                        @php
                                                                            $color = 'green'
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $color = 'red'
                                                                        @endphp
                                                                    @endif
                                                                    <div class="cursor-pointer bg-{{$color}}-500 hover:bg-{{$color}}-600 shadow font-bold py-1 px-3 rounded text-white transition">
                                                                        {{$produit->stocks->where('id_produit', $produit->id)->sum('qte_disponible')}}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <div class="card shadow-md border w-1/2 mt-3">
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white">Total</th>
                                                        <td class="relative px-6 py-4 text-right w-full">
                                                            <input id="prix-total" disabled style="border-bottom: 1px dashed gray;" type="number" step="0.01" name="total" value="{{old('total') ? old('total') : 0}}" class="text-gray-500 border-0">
                                                            <span id="total-devise" style="top: 1.5rem; right: 1.5rem;" class="absolute block inline-flex items-center px-3 border-0 text-gray-500 text-sm">DH</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Creer Client Modal -->
            <div id="ajouterClientModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-300 w-full md:inset-0 h-modal md:h-1/2">
                <div class="modal-container py-6 relative p-4 w-full h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="modal-content bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-center p-6 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                Ajouter Un Client
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-2 ml-auto inline-flex items-center transition" data-modal-toggle="ajouterClientModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 modal-body bg-gray-100" id="nprogcontainer">
                            <div class="hidden success-container" id="client-alert-success">
                                <div class="success bg-red-100 border px-3 py-3 rounded-lg" role="alert">
                                    <svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="px-3">Le client est ajouté avec succès</span>
                                </div>
                            </div>
                            <div class="alert-container">
                                <ul id="client-errors-list">
                                </ul>
                            </div>
                            @php
                                $route = '';
                                $client = null;
                                $num_client = $clients->max('num_client') + 1;
                            @endphp
                            @include('client.create_form')
                        </div>
                        <!-- Modal footer -->
                        <div class="flex justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button form="clientData" type="submit" class="btn btn-indigo" style="margin: 0 15px;">
                                Enregistrer
                            </button>
                            <button data-modal-toggle="ajouterClientModal" id="annulerAjouterClientModal" type="button" class="btn btn-red">
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    @endsection
    @section('script')
        <script src="/js/script.js"></script>
        <script>
            $(document).ready(function () {
                $('#clientData').on('submit', function (e) {
                    NProgress.configure({ parent: '#nprogcontainer' });
                    NProgress.start();
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "/produit/ajouter-produit/ajouter-client",
                        data: $('#clientData').serialize(),
                        success: function (response) {
                            $('#client-errors-list').empty()
                            $('#client').append('<option value='+response['id']+' selected>'+response['name']+'</option>');
                            $('#annulerAjouterClientModal').trigger( "click" )
                            $('#clientData')[0].reset()
                        },
                        error: function (error) 
                        {
                            $('#client-errors-list').empty()
                            let errors = error.responseJSON.errors
                            $.each(errors, function(errorName, errorVal) {
                                $('#client-errors-list').append('<li><div class="alert bg-red-100 border px-3 py-3 rounded-lg" role="alert"><svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="px-3">'+errorVal[0]+'</span></div></li>')
                            });
                        }
                    })
                    NProgress.done();
                });
            })
        </script>
    @endsection
</x-app-layout>