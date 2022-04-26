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
                <div class="py-12 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6 px-4 py-5 bg-white sm:p-6 shadow overflow-hidden sm:rounded-md">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                                <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label for="libele" class="block text-sm font-medium text-gray-700">Libelé</label>
                                    <input type="text" name="libele" id="libele" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                    
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="unite" class="block text-sm font-medium text-gray-700">Unité de stock</label>
                                    <input type="text" name="unite" id="unite" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="code_barre" class="block text-sm font-medium text-gray-700">Code barre</label>
                                    <input type="text" name="code_barre" id="code_barre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                
                                <div class="col-span-6 ">
                                    <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                                    <div class="mt-1">
                                        <textarea id="description" name="description" rows="6" class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">Description brève du produit.</p>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            
                <div>
                    <hr>
                </div>

                <div class="py-12">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6 shadow sm:rounded-md sm:overflow-hidden py-12 md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Géstion de stock</h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="min_stock" class="block text-sm font-medium text-gray-700">Niveau de stock initial</label>
                                    <input type="number" step="0.01" name="min_stock" id="min_stock" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="prix_initial" class="block text-sm font-medium text-gray-700">Prix initial</label>
                                    <input type="number" name="prix_initial" id="prix_initial" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                    
                                <div class="col-span-6">
                                    <label for="zone" class="block text-sm font-medium text-gray-700">Emplacement</label>
                                    <input type="text" name="zone" id="zone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-12">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6 shadow sm:rounded-md sm:overflow-hidden py-12 md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Plus de détails</h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="fournisseur" class="w-full block text-sm font-medium text-gray-700">Fournisseur</label>
                                    <div class="flex justify-between">
                                        <select id="fournisseur" name="fournisseur" class=" mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option selected disabled>Selectionner un fournisseur</option>
                                            @if ($fournisseurs->count() == 0)
                                                <option disabled>Désolés, nous ne trouvant pas de fournisseurs</option>
                                            @else
                                                @foreach ($fournisseurs as $fournisseur)
                                                    <option value="{{$fournisseur->id}}">{{$fournisseur->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="px-3">
                                            <a data-modal-toggle="ajouterFournisseurModal" style="margin-top: 10px" type="button" {{-- style="margin-top: 25px" --}} class="cursor-pointer px-3 py-2 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                
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
                                                    <option value="{{$categorie->id}}">{{$categorie->libele}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="px-3">
                                            <a data-modal-toggle="ajouterFournisseurModal" style="margin-top: 10px" type="button" {{-- style="margin-top: 25px" --}} class="cursor-pointer px-3 py-2 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                
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
                                                    <option value="{{$marque->id}}">{{$marque->libele}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="px-3">
                                            <a data-modal-toggle="ajouterFournisseurModal" style="margin-top: 10px" type="button" {{-- style="margin-top: 25px" --}} class="cursor-pointer px-3 py-2 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                
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
                                        <input type="number" name="poids" id="poids" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
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
            </form>
        </div>
        
        <!-- Annuler Formulaire Modal -->
        <div id="defaultModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-full md:h-full">
            <div class="relative modal-container w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-1/2">
                    <!-- Modal header -->
                    <div class="flex justify-end p-2">
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="defaultModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 pt-0 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Vous êtes sur le point de quitter ce formulaire, votre travail ne sera pas enregistré. Êtes-vous sûr de vouloir continuer ?
                        </h3>
                        <a href="{{route('produit.index')}}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                            Oui, je suis sur
                        </a>
                        <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Non, rester sur ce formulaire
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Extra Large Modal -->
        <div id="ajouterFournisseurModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-7xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Extra Large modal
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="ajouterFournisseurModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        @include('fournisseur.create_form')
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button data-modal-toggle="ajouterFournisseurModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        <button data-modal-toggle="ajouterFournisseurModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>