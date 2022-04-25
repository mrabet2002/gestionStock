<div class="containerc">
    <form action="{{route('fournisseur.store')}}" method="POST" enctype="multipart/form-data" id="productData">
        @csrf
        <div class="py-12 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6 px-4 py-5 bg-white sm:p-6 shadow overflow-hidden sm:rounded-md">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="libele" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="libele" id="libele" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
            
                        <div class="col-span-6 sm:col-span-3">
                            <label for="num_fournisseur" class="block text-sm font-medium text-gray-700">Numéro Fournisseur</label>
                            <input type="text" name="num_fournisseur" id="num_fournisseur" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        <div class="col-span-6 sm:col-span-3">
                            <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" name="tel" id="tel" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
        </div>
    
        <div>
            <hr>
        </div>

        <div class="py-12">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6 shadow sm:rounded-md sm:overflow-hidden py-12 md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-bold leading-6 text-gray-900">Adresse</h3>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <input type="text" step="0.01" name="adresse" id="adresse" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="pays" class="block text-sm font-medium text-gray-700">Pays</label>
                            <input type="text" name="pays" id="pays" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
            
                        <div class="col-span-6 sm:col-span-3">
                            <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                            <input type="text" name="ville" id="ville" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6">
                            <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal</label>
                            <input type="text" name="code_postal" id="code_postal" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                        

            
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="site_web" class="block text-sm font-medium text-gray-700">Site Web</label>
                            <input type="text" name="site_web" id="site_web" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6">
                            <label for="devise" class="block text-sm font-medium text-gray-700">Devise</label>
                            <input type="text" name="devise" id="devise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        {{-- fichier_attache field --}}
                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700"> Fichier attaché </label>
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
                                        <input id="fichier_attache" name="fichier_attache" type="file" class="file-input sr-only" onchange="previewFile()">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
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
                <a href="{{route('fournisseur.index')}}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                    Oui, je suis sur
                </a>
                <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Non, rester sur ce formulaire
                </button>
            </div>
        </div>
    </div>
</div>