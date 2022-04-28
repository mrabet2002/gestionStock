<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __("Créer un ordre d'chat") }}
                </div>
                <div class="py-1">
                        <a type="button" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo transition" >
                            <span class="mr-3">
                                Annuler
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </a>
                        <button type="submit" form="achatData" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo active:bg-gray-50 transition">
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
                <form action="{{route('achat.store')}}" method="POST" enctype="multipart/form-data" id="achatData">
                    @csrf
                    <div class="py-12 sm:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-6 sm:p-6 overflow-hidden">
                            <div class="card shadow-md">
                                <div class="flex justify-start p-6 card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                                    </div>
                                </div><hr>
                                <div class="mt-5 md:mt-0 card-body">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="fournisseur" class="w-full block text-sm font-medium text-gray-700">Fournisseur</label>
                                            <div class="flex justify-between">
                                                <select id="fournisseur" name="fournisseur" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option selected disabled>Selectionner un fournisseur</option>
                                                    @if ($fournisseurs->count() == 0)
                                                        <option disabled>Désolés, nous ne trouvant pas de fournisseurs</option>
                                                    @else
                                                        @foreach ($fournisseurs as $fournisseur)
                                                            <option value="{{$fournisseur->id}}" {{$fournisseur->id == old('fournisseur') ? "selected" : ""}}>
                                                                {{$fournisseur->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="px-3">
                                                    <a data-modal-toggle="ajouterFournisseurModal" style="margin-top: 10px" type="button" {{-- style="margin-top: 25px" --}} class="btn btn-indigo transition">
                                                        
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
                                                <textarea id="description" name="description" rows="6" class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Description brève du fournisseur.</p>
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
                                            <input type="date" step="0.01" name="date_creation" id="date_creation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="remiseAchat" class="block text-sm font-medium text-gray-700"> Remise </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                <input type="number" name="remiseAchat" id="remiseAchat" value="{{old('remiseAchat')}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="devie" class="block text-sm font-medium text-gray-700">Devise</label>
                                            <input type="text" name="devie" id="devie" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                
                                        <div class="col-span-6">
                                            <label for="taxe" class="block text-sm font-medium text-gray-700">Taxe</label>
                                            <input type="number" step="0.01" name="taxe" id="taxe" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="card shadow-md">
                                    <div class="flex justify-start card-head">
                                        <div class="px-4 sm:px-0">
                                            <h3 class="text-lg font-bold leading-6 text-gray-900">Produits</h3>
                                        </div>
                                    </div><hr>
                                    <div class="mt-5 md:mt-0 card-body">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-xs text-white uppercase bg-blue-500 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Produit
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Prix
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Qté
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Remise
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="LigneCommandeRow" style="display: none">
                                                    <td class="produitCell px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                        <div class="flex justify-between">
                                                            <select name="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option selected disabled>Selectionner un produit</option>
                                                                @if ($produits->count() == 0)
                                                                    <option disabled>Désolés, nous ne trouvant pas de produits</option>
                                                                @else
                                                                    @foreach ($produits as $produit)
                                                                        <option value="{{$produit->id}}">{{$produit->libele}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <div class="px-3">
                                                                <a href="{{route('produit.create')}}" style="margin-top: 10px" type="button" {{-- style="margin-top: 25px" --}} class="btn btn-indigo transition">
                                                                    
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="prixCell px-6 py-4">
                                                        <div class="col-span-6">
                                                            <input type="number" step="0.01" name=""  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="mt-1 flex rounded-md shadow-sm">
                                                            <input type="number" name="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="mt-1 flex rounded-md shadow-sm">
                                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                            <input type="number" name="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                                        </div>
                                                    </td>
                                                    <td class="py-4">
                                                    </td>
                                                </tr>
                                                @php
                                                    $i = 1
                                                @endphp
                                                
                                                @if (old('lignesAchat'))
                                                    @foreach (old('lignesAchat') as $key => $value)
                                                        <tr id="{{$key}}" class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                            <td class="produitCell px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                                <div class="flex justify-between">
                                                                    <select name="lignesAchat[{{$key}}][id_produit]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                        <option selected disabled>Selectionner un produit</option>
                                                                        @if ($produits->count() == 0)
                                                                            <option disabled>Désolés, nous ne trouvant pas de produits</option>
                                                                        @else
                                                                            @foreach ($produits as $produit)
                                                                                <option value="{{$produit->id}}" {{$produit->id == old('lignesAchat.'.$key.'.id_produit') ? "selected" : ""}}>{{$produit->libele}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    <div class="px-3">
                                                                        <a href="{{route('produit.create')}}" style="margin-top: 10px" type="button" class="btn btn-indigo transition">
                                                                            
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="prixCell px-6 py-4">
                                                                <div class="col-span-6">
                                                                    <input type="number" step="0.01" name="lignesAchat[{{$key}}][prix]" value="{{old('lignesAchat.'.$key.'.prix')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                                    <input type="number" name="lignesAchat[{{$key}}][qte]" value="{{old('lignesAchat.'.$key.'.qte')}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                                    
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                                    <input type="number" name="lignesAchat[{{$key}}][remise]" value="{{old('lignesAchat.'.$key.'.remise')}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                                                </div>
                                                            </td>
                                                            <td class="py-4">
                                                                <button id="{{$key}}" type="button" class="delete-product hover:bg-red-500 hover-text-white border rounded-md py-1 px-3 text-red-500 transition">
                                                                    X
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="mt-3 text-center">
                                            <button id="ajouterLigneAchat" type="button" class=" btn btn-blue inline-flex items-center transition">
                                                <span class="mr-3">
                                                    Ajouter une ligne
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
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