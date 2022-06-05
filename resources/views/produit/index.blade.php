<x-app-layout>
    <x-slot name="header">
        <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex items-center">
                {{ __('Produits') }}
            </div>
            <div class="text-right">
                <span class="rounded-md">
                    <a href="{{route('produit.create')}}" type="button" class="cursor-pointer btn-indigo inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-500 active:bg-gray-50 transition">
                        <span class="mr-3">
                            Créer Un Produit
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </a>
                    <a type="button" id="dropdownAutreButton" data-dropdown-toggle="dropdownAutre" class="cursor-pointer btn-indigo inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-500 active:bg-gray-50 transition">
                        <span class="mr-3">
                            Autre
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-square" viewBox="0 0 16 16">
                            <path d="M3.626 6.832A.5.5 0 0 1 4 6h8a.5.5 0 0 1 .374.832l-4 4.5a.5.5 0 0 1-.748 0l-4-4.5z"/>
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2z"/>
                        </svg>
                    </a>
                    <div id="dropdownAutre" class="z-10 shadow-lg border-2 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownAutreButton">
                            <li class="cursor-pointer block flex justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">                                        
                                <a href="{{route('categorie.index')}}">
                                    <div class="py-2">
                                        Catégorie
                                    </div>
                                </a>
                            </li>
                            <li class="cursor-pointer block flex justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">                                        
                                <a href="{{route('marque.index')}}">
                                    <div class="py-2">
                                        Marque
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </span>
            </div>
        </h2>
    </x-slot>
    @section('content')
        @if (session()->has('success'))
            <div class="success-container">
                <div class="success bg-red-100 border px-3 py-3 rounded-lg" role="alert">
                    <svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="px-3">{{ session()->get('success') }}</span>
                </div>
            </div>
        @endif
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
        <div class=" py-12">
            <div class="w-3/4 mx-auto px-6 py-12 bg-white border-0 shadow-lg rounded-lg">
                <div class="relative overflow-x-auto">
                    <div class="py-3 px-3">
                        <label for="table-search">Search</label>
                        <div class="md:grid md:grid-cols-2 gap-6">
                            <div class="flex">
                                <div class="relative mt-1">
                                    <input type="text" id="table-search" value="" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Search for items"
                                    onkeyup="chercherLigne(event, 'body', 1)">
                                </div>
                                <div class="flex align-center">
                                    <div class="px-6 flex align-center">
                                        <button class="text-indigo-500 hover:text-indigo-400 transition" type="button" id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider" data-dropdown-placement="right-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownDivider" class="z-10 shadow-lg border-2 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
                                        <li class="cursor-pointer block flex justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">                                        
                                            <div class="py-2">
                                                Libelé
                                            </div>
                                            <div class="py-2">
                                                <input id="1" value="1" type="radio" name="filtrer-par" class="filtrer-par w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded-full focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        </li>
                                        <li class="cursor-pointer block flex justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">                                        
                                            <div class="py-2">
                                                Fournisseur
                                            </div>
                                            <div class="pl-6 py-2">
                                                <input id="2" value="2" type="radio" name="filtrer-par" class="filtrer-par w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded-full focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        </li>
                                        <li class="cursor-pointer block flex justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">                                        
                                            <div class="py-2">
                                                Catégorie
                                            </div>
                                            <div class="pl-6 py-2">
                                                <input id="3" value="3" type="radio" name="filtrer-par" class="filtrer-par w-4 h-4 text-indigo-600 bg-gray-100 border-gray-200 rounded-full focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        </li>
                                        <li class="cursor-pointer block flex justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">                                        
                                            <div class="py-2">
                                                Marque
                                            </div>
                                            <div class="pl-6 py-2">
                                                <input id="4" value="4" type="radio" name="filtrer-par" class="filtrer-par w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded-full focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end align-center">
                                <form action="{{route('produit.export')}}" method="post" id="expoterproduits">
                                    @csrf
                                    <button class="btn btn-blue w-fit mr-2" form="expoterproduits">
                                        Exporter
                                    </button>
                                </form>
                                <form action="{{route('produit.import')}}" method="post" enctype="multipart/form-data" id="importerproduits">
                                    @csrf
                                    <label class="btn btn-orange w-fit">
                                        <span>Importer</span>
                                        <input class="file-input sr-only" type="file" name="importerproduits" id="importerproduits" form="importerproduits" onchange="document.querySelector('form#importerproduits').submit()">
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-4 px-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox" 
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            onclick="checkAllToggel(event)">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between">
                                            <div class="flex align-center">
                                                libelé
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition">
                                                <svg onclick="trierString(event, 1, 'body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between">
                                            <div class="flex align-center">
                                                Fournisseur
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition">
                                                <svg onclick="trierString(event, 2, 'body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between">
                                            <div class="flex align-center">
                                                Catégorie
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition">
                                                <svg onclick="trierString(event, 3, 'body')" id="trie-icone" ordre="desc" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between">
                                            <div class="flex align-center">
                                                marque
                                            </div>
                                            <button class="cursor-pointer rounded ordre-icone transition">
                                                <svg onclick="trierString(event, 4, 'body')" id="trie-icone" ordre="desc" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="body">
                                @foreach ($produits as $produit)
                                    <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 px-4">
                                            <div class="flex items-center">
                                                <input form="expoterproduits" id="{{$produit->id}}" value="{{$produit->id}}" name="produits[{{$produit->id}}]" type="checkbox" class="checkboxs w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{$produit->libele}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$produit->id_fournisseur ? $produit->fournisseur->name : ""}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$produit->categorie ? $produit->categorie->libele : ""}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$produit->id_marque ? $produit->marque->libele : ""}}
                                        </td>
                                        <td class="py-4">
                                            <div class="flex justfy-between items-center">
                                                <a href="{{route('produit.show',$produit->id)}}" class="px-3 text-indigo-500 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </a>
    
                                                <a href="{{route('produit.edit',$produit->id)}}" class="px-3 edit-btn transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg>
                                                </a>
                                                
                                                <a data-modal-toggle={{"supprimerProduit".$produit->id}} type="button" class="delete-product px-3 text-red-500 delete-btn transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <!-- Supprimer produit Modal -->
                                            <div id={{"supprimerProduit".$produit->id}}  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-full md:h-full">
                                                <div class="relative modal-container w-full max-w-md h-full md:h-auto">
                                                    <!-- Modal content -->
                                                    <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-1/2">
                                                        <!-- Modal header -->
                                                        <div class="flex justify-end p-2">
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle={{"supprimerProduit".$produit->id}} >
                                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-6 pt-0 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                                Vous êtes sûr de supprimer ce produit ?
                                                            </h3>
                                                            <form action="{{route('produit.destroy',$produit->id)}}" method="post">
                                                                @csrf
                                                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                                                                    Oui
                                                                </button>
                                                                <button data-modal-toggle={{"supprimerProduit".$produit->id}}  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Non
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    @endsection
    @section('script')
        <script src="/js/script.js"></script>
    @endsection
</x-app-layout>