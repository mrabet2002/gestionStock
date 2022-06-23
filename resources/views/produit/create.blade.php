<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __('Créer un nouveau produit') }}
                </div>
                <div class="py-1">
                    <a type="button" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo transition" data-modal-toggle="defaultModal">
                        <span class="mr-3">
                            Annuler
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                    </a>
                    <button type="submit" form="productData" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo active:bg-gray-50 transition">
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
            <form action="{{route('produit.store')}}" method="POST" enctype="multipart/form-data" id="productData">
                @csrf
                <div class="sm:mt-0">
                    <div class="md:grid md:grid-cols-2 overflow-hidde">
                        <div class="card shadow-md" style="height: fit-content">
                            <div class="flex justify-start p-6 card-head">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                                </div>
                            </div><hr>
                            <div class="mt-5 md:mt-0 card-body">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="libele" class="block text-sm font-medium text-gray-700">Libelé</label>
                                        <input type="text" name="libele" id="libele"
                                        value="{{old('libele')}}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="unite" class="block text-sm font-medium text-gray-700">Unité de stock</label>
                                        <input type="text" name="unite" id="unite"
                                        value="{{old('unite')}}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="code_barre" class="block text-sm font-medium text-gray-700">Code barre</label>
                                        <input type="text" name="code_barre" id="code_barre"
                                        value="{{old('code_barre')}}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-6 ">
                                        <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                                        <div class="mt-1">
                                            <textarea id="description" name="description" rows="6"
                                            class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">
                                            {{old('description')}}
                                        </textarea>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">Description brève du produit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:grid gap-2">
                            <div class="card shadow-md">
                                <div class="flex justify-start card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Géstion de stock</h3>
                                    </div>
                                </div><hr>
                                <div class="mt-5 md:mt-0 card-body">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="min_stock" class="block text-sm font-medium text-gray-700">Niveau de stock initial</label>
                                            <input type="number" step="0.01" name="min_stock" id="min_stock" 
                                            value="{{old('min_stock')}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
        
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="prix_initial" class="block text-sm font-medium text-gray-700">Prix initial</label>
                                            <input type="number" name="prix_initial" id="prix_initial" 
                                            value="{{old('prix_initial')}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                            
                                        <div class="col-span-6">
                                            <label for="zone" class="block text-sm font-medium text-gray-700">Emplacement</label>
                                            <input type="text" name="zone" id="zone" 
                                            value="{{old('zone')}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie</label>
                                            <div class="flex justify-between">                                        
                                                <select id="categorie" name="categorie" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option selected disabled>Selectionner une catégorie</option>
                                                    @if ($categories->count() == 0)
                                                        <option disabled>Désolés, nous ne trouvant pas de catégories</option>
                                                    @else
                                                        @foreach ($categories as $categorie)
                                                            <option value="{{$categorie->id}}" {{$categorie->id == old('categorie') ? "selected" : ""}}>
                                                                {{$categorie->libele}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="px-3">
                                                    <a data-modal-toggle="ajouterCategorieModal" style="margin-top: 10px" type="button" class="btn btn-indigo transition">
                                                        
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="marque" class="block text-sm font-medium text-gray-700">Marque</label>
                                            <div class="flex justify-between">                                        
                                                <select id="marque" name="marque" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option selected disabled>Selectionner une marque</option>
                                                    @if ($marques->count() == 0)
                                                        <option disabled>Désolés, nous ne trouvant pas de marques</option>
                                                    @else
                                                        @foreach ($marques as $marque)
                                                            <option value="{{$marque->id}}" {{$marque->id == old('marque') ? "selected" : ""}}>{{$marque->libele}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="px-3">
                                                    <a data-modal-toggle="ajouterMarqueModal" style="margin-top: 10px" type="button" class="btn btn-indigo transition">
                                                        
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-6">
                                            <label for="poids" class="block text-sm font-medium text-gray-700"> Poids </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> Kg </span>
                                                <input type="number" name="poids" id="poids" 
                                                value="{{old('poids')}}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                        {{-- Image field --}}
                                        <div class="col-span-6">
                                            <label class="block text-sm font-medium text-gray-700"> Image </label>
                                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                        <div class="px-6">
                                                            <span>Choisisser une image</span>
                                                            <img class="Image-preview mx-auto" style="display: none;" src="" width="50%" alt="Image preview...">
                                                            <p class="pdf-preview text-gray-500" style="display: none;"></p>
                                                        </div>
                                                        <input id="image" name="image" type="file" class="file-input sr-only" onchange="previewFile(false)">
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Annuler Formulaire Modal -->
        <div id="defaultModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-200 md:inset-0 h-full md:h-full">
            <div class="relative modal-container w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-3/4">
                    <!-- Modal header -->
                    <div class="flex justify-end p-2">
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-2 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="defaultModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                        
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 pt-0 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Votre travail ne sera pas enregistré. Êtes-vous sûr de vouloir continuer ?
                        </h3>
                        <a href="{{route('produit.index')}}" type="button" class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                            Oui, je suis sur
                        </a>
                        <button data-modal-toggle="defaultModal" type="button" class="mt-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Non, rester sur ce formulaire
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Creer Fournisseur Modal -->
        <div id="ajouterFournisseurModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-300 w-full md:inset-0 h-modal md:h-1/2">
            <div class="modal-container py-6 relative p-4 w-full h-full md:h-auto">
                <!-- Modal content -->
                <div class="modal-content bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center p-6 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Ajouter Un Fournisseur
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-2 ml-auto inline-flex items-center transition" data-modal-toggle="ajouterFournisseurModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 modal-body bg-gray-100" id="fournisseur-nprog-container">
                        <div class="hidden success-container" id="fournisseur-alert-success">
                            <div class="success bg-red-100 border px-3 py-3 rounded-lg" role="alert">
                                <svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="px-3">Le fournisseur est ajouté avec succès</span>
                            </div>
                        </div>
                        <div class="alert-container">
                            <ul id="fournisseur-errors-list">
                            </ul>
                        </div>
                        @php
                            $route = '';
                            $fournisseur = null;
                            $num_fournisseur = $fournisseurs->max('num_fournisseur') + 1;
                        @endphp
                        @include('fournisseur.create_form')
                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button form="fournisseurData" type="submit" class="btn btn-indigo" style="margin: 0 15px;">
                            Enregistrer
                        </button>
                        <button data-modal-toggle="ajouterFournisseurModal" id="annulerAjouterFournisseurModal" type="button" class="btn btn-red">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Creer Categorie Modal -->
        <div id="ajouterCategorieModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-300 w-full md:inset-0 h-modal md:h-1/2">
            <div class="modal-container py-6 relative p-4 w-full h-full md:h-auto">
                <!-- Modal content -->
                <div class="modal-content bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center p-6 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Ajouter Une Catégorie
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-2 ml-auto inline-flex items-center transition" data-modal-toggle="ajouterCategorieModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 modal-body bg-gray-100" id="categorie-nprog-container">
                        <div class="hidden success-container" id="categorie-alert-success">
                            <div class="success bg-red-100 border px-3 py-3 rounded-lg" role="alert">
                                <svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="px-3">La catégorie est ajouté avec succès</span>
                            </div>
                        </div>
                        <div class="alert-container">
                            <ul id="categorie-errors-list">
                            </ul>
                        </div>
                        @php
                            $route = '';
                        @endphp
                        @include('categorie.form')
                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button form="categorieData" type="submit" class="btn btn-indigo" style="margin: 0 15px;">
                            Enregistrer
                        </button>
                        <button data-modal-toggle="ajouterCategorieModal" id="annulerAjouterCategorieModal" type="button" class="btn btn-red">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Creer Marque Modal -->
        <div id="ajouterMarqueModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-300 w-full md:inset-0 h-modal md:h-1/2">
            <div class="modal-container py-6 relative p-4 w-full h-full md:h-auto">
                <!-- Modal content -->
                <div class="modal-content bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center p-6 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Ajouter Une Marque
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-2 ml-auto inline-flex items-center transition" data-modal-toggle="ajouterMarqueModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 modal-body bg-gray-100" id="marque-nprog-container">
                        <div class="hidden success-container" id="marque-alert-success">
                            <div class="success bg-red-100 border px-3 py-3 rounded-lg" role="alert">
                                <svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="px-3">La marque est ajouté avec succès</span>
                            </div>
                        </div>
                        <div class="alert-container">
                            <ul id="marque-errors-list">
                            </ul>
                        </div>
                        @php
                            $route = '';
                        @endphp
                        @include('marque.form') 
                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button form="marqueData" type="submit" class="btn btn-indigo" style="margin: 0 15px;">
                            Enregistrer
                        </button>
                        <button data-modal-toggle="ajouterMarqueModal" id="annulerAjouterMarqueModal" type="button" class="btn btn-red">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            $(document).ready(function () {
                $('#fournisseurData').on('submit', function (e) {
                    NProgress.configure({ parent: '#fournisseur-nprog-container' });
                    NProgress.start();
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "/produit/ajouter-produit/ajouter-fournisseur",
                        data: $('#fournisseurData').serialize(),
                        success: function (response) {
                            $('#fournisseur-errors-list').empty()
                            $('#fournisseur').append('<option value='+response['id']+' selected>'+response['name']+'</option>');
                            $('#annulerAjouterFournisseurModal').trigger( "click" )
                            $('#fournisseurData')[0].reset()
                        },
                        error: function (error) 
                        {
                            $('#fournisseur-errors-list').empty()
                            let errors = error.responseJSON.errors
                            $.each(errors, function(errorName, errorVal) {
                                $('#fournisseur-errors-list').append('<li><div class="alert bg-red-100 border px-3 py-3 rounded-lg" role="alert"><svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="px-3">'+errorVal[0]+'</span></div></li>')
                            });
                        }
                    })
                    NProgress.done();
                });
                $('#categorieData').on('submit', function (e) {
                    NProgress.configure({ parent: '#categorie-nprog-container' });
                    NProgress.start();
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "/produit/ajouter-produit/ajouter-categorie",
                        data: $('#categorieData').serialize(),
                        success: function (response) {
                            $('#categorie-errors-list').empty()
                            $('#categorie').append('<option value='+response['id']+' selected>'+response['libele']+'</option>');
                            $('#annulerAjouterCategorieModal').trigger( "click" )
                            $('#categorieData')[0].reset()
                        },
                        error: function (error) 
                        {
                            $('#categorie-errors-list').empty()
                            let errors = error.responseJSON.errors
                            $.each(errors, function(errorName, errorVal) {
                                $('#categorie-errors-list').append('<li><div class="alert bg-red-100 border px-3 py-3 rounded-lg" role="alert"><svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="px-3">'+errorVal[0]+'</span></div></li>')
                            });
                        }
                    })
                    NProgress.done();
                })
                $('#marqueData').on('submit', function (e) {
                    NProgress.configure({ parent: '#marque-nprog-container' });
                    NProgress.start();
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "/produit/ajouter-produit/ajouter-marque",
                        data: $('#marqueData').serialize(),
                        success: function (response) {
                            $('#marque-errors-list').empty()
                            $('#marque').append('<option value='+response['id']+' selected>'+response['libele']+'</option>');
                            $('#annulerAjouterMarqueModal').trigger( "click" )
                            $('#marqueData')[0].reset()
                        },
                        error: function (error) 
                        {
                            $('#marque-errors-list').empty()
                            let errors = error.responseJSON.errors
                            $.each(errors, function(errorName, errorVal) {
                                $('#marque-errors-list').append('<li><div class="alert bg-red-100 border px-3 py-3 rounded-lg" role="alert"><svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="px-3">'+errorVal[0]+'</span></div></li>')
                            });
                        }
                    })
                    NProgress.done();
                })
            })
        </script>
    @endsection
</x-app-layout>