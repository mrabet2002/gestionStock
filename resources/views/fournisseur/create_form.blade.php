<div class="containerc">
    <form action="{{route('fournisseur.store')}}" method="POST" enctype="multipart/form-data" id="fournisseurData">
        @csrf
        {{-- <div class="py-12 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6 px-4 py-5 bg-white sm:p-6 shadow overflow-hidden sm:rounded-md">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="nom" id="nom" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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

        <div>
            <hr>
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
                                        <input id="fichier_attache" name="fichier_attache" type="file" class="file-input sr-only" onchange="previewFile(true)">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
                            <div class="col-span-6">
                                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" name="nom" id="nom" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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

                <div class="card shadow-md">
                    <div class="flex justify-start card-head">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-bold leading-6 text-gray-900">Adresse</h3>
                        </div>
                    </div><hr>
                    <div class="mt-5 md:mt-0 card-body">
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
                <div class="col-span-2">
                    <div class="card shadow-md">
                        <div class="flex justify-start card-head">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Plus de détails</h3>
                            </div>
                        </div><hr>
                        <div class="mt-5 md:mt-0 card-body">
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
                                                <input id="fichier_attache" name="fichier_attache" type="file" class="file-input sr-only" onchange="previewFile(true)">
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
            </div>
        </div>
    </form>
</div>

