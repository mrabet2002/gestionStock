<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __($fournisseur->name) }}
                </div>
                <div class="py-1">
                        <form action="{{route('fournisseur.edit',$fournisseur->id)}}" id="modifierProd"></form>
                        <button type="submit" class="inline-flex items-center btn btn-blue transition" form="modifierProd">
                            <span class="mr-3">
                                Modifier
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                        <button data-modal-toggle="supprimerfournisseur" class="inline-flex items-center btn btn-red transition">
                            <span class="mr-3">
                                Supprimer
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <!-- Supprimer fournisseur Modal -->
                        <div id="supprimerfournisseur"  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-full md:h-full">
                            <div class="relative modal-container w-full max-w-md h-full md:h-auto">
                                <!-- Modal content -->
                                <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-1/2">
                                    <!-- Modal header -->
                                    <div class="flex justify-end p-2">
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="supprimerfournisseur" >
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 pt-0 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                                            Vous êtes sûr de supprimer ce fournisseur ?
                                        </h3>
                                        <form action="{{route('fournisseur.destroy',$fournisseur->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                                                Oui
                                            </button>
                                            <button data-modal-toggle="supprimerfournisseur"  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Non
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </x-slot>
    @section('content')
    <div class="containerc mt-6 mb-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex align-center justify-center py-12 bg-gray-50 rounded-md">
                            <div class="welcome text-center">
                                <h1>{{$fournisseur->name}}</h1>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Détails</h1>
                            <div class="py-2"><hr></div>
                            <table>
                                @if ($fournisseur->email)
                                <tr>
                                    <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">E-mail</th>
                                    <td class="px-6 py-4 text-right w-full"><a href="mailto:{{$fournisseur->email}}">{{$fournisseur->email}}</a></td>
                                </tr>
                                @endif
                                @if ($fournisseur->tel)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Téléphone</th>
                                        <td class="px-6 py-4 text-right w-full"><a href="tel:{{$fournisseur->tel}}">{{$fournisseur->tel}}</a></td>
                                    </tr>
                                @endif
                                @if ($fournisseur->adresse)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Adresse</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->adresse}} DH</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->pays)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Pays</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->pays}}</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->ville)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Ville</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->ville}}</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->code_postal)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Code postal</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->code_postal}}</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->site_web)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Site Web</th>
                                        <td class="px-6 py-4 text-right w-full"><a href="{{$fournisseur->site_web}}" target="_blank">{{$fournisseur->site_web}}</a></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if ($fournisseur->description)
                <div class="col">
                    <div class="bg-white shadow-lg rounded-lg p-6" style="height: fit-content">
                        <h1 class="text-xl font-bold">Description</h1>
                        <div class="py-2"><hr></div>
                        <p style="text-align: justify">{{$fournisseur->description}}</p>
                    </div>
                </div>
            @endif
            @if ($fournisseur->fichier_attacher)
                <div class="col">
                    <div class="bg-white shadow-lg rounded-lg p-6" style="height: fit-content">
                        <h1 class="text-xl font-bold">Fichier attacher</h1>
                        <div class="py-2"><hr></div>
                        <div class="welcome-img">
                            <iframe width="100%" style="height: 100mm" csp="true" allowfullscreen="true" src="/uploads/{{$fournisseur->fichier_attacher}}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($fournisseur->produits->toArray()))
                <div class="col-span-2">
                    <div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg rounded-lg">
                        <div class="font-bold px-2 py-2 text-lg">
                            <h1>Produits</h1>
                        </div><hr>
                        <div class="relative overflow-x-auto">
                            <div class="py-3 px-3">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-white uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-4 px-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                <div class="flex justify-between">
                                                    <div class="flex align-center">
                                                        libelé
                                                    </div>
                                                    <div class="cursor-pointer rounded ordre-icone transition">
                                                        <svg onclick="trierString(event, 2)" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
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
                                                        <svg onclick="trierString(event, 3)" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
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
                                                    <div class="cursor-pointer rounded ordre-icone transition">
                                                        <svg onclick="trierString(event, 4)" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fournisseur->produits as $produit)
                                            <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="w-4 px-4">
                                                    <div class="flex items-center">
                                                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </div>
                                                </td>
                                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                    {{$produit->libele}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{$produit->categorie->libele}}
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
            @endif
        </div>
    @endsection
    @section('script')
    <script src="/js/script.js"></script>
    <script src="/js/JsBarcode.all.min.js"></script>
        <script>
            let code_barre = document.querySelector('.code_barre').innerHTML;
            JsBarcode("#barcode", code_barre);
        </script>
    @endsection
</x-app-layout>