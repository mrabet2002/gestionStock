<div class="containerc">
    <form action="{{$route}}"  method="POST" enctype="multipart/form-data" id="clientData">
        @csrf
        <div class="sm:mt-0">
            <div class="md:grid md:grid-cols-2 overflow-hidden">
                <div class="card shadow-md" style="height: fit-content">
                    <div class="flex justify-start p-6 card-head">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                        </div>
                    </div><hr>
                    <div class="mt-5 md:mt-0 card-body">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" name="nom" id="nom" 
                                value="{{old('nom') ? old('nom') : (isset($client) ? $client->name : "")}}" 
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                
                            <div class="col-span-6 sm:col-span-3">
                                <label for="num_client" class="block text-sm font-medium text-gray-700">Numéro client</label>
                                <input type="text" name="num_client" id="num_client" 
                                value="{{old('num_client') ? old('num_client') : 
                                (isset($client) ? $client->num_client : $num_client)}}" 
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            
                            <div class="col-span-6 sm:col-span-3">
                                <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="text" name="tel" id="tel" 
                                value="{{old('tel') ? old('tel') : 
                                (isset($client) ? $client->tel : "")}}" 
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>     

                            <div class="col-span-6">
                                <label for="tel" class="block text-sm font-medium text-gray-700">Statut du client</label>
                                <div class="flex justify-between">
                                    <select id="statut" name="statut" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @if (isset($client))
                                            <option value="pp" {{old('statut') == 'pp' || $client->statut == 'pp' ? "selected" : ""}} selected>
                                                Personne physique
                                            </option>
                                            <option value="pm" {{old('statut') == 'pm' || $client->statut == 'pm' ? "selected" : ""}}>Personne morale</option>
                                            @else
                                            <option value="pp" {{old('statut') == 'pp' ? "selected" : ""}} selected>
                                                Personne physique
                                            </option>
                                            <option value="pm" {{old('statut') == 'pm' ? "selected" : ""}}>Personne morale</option>
                                        @endif
                                    </select>
                                </div>
                            </div>                        
                            
                            <div class="col-span-6 ">
                                <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="6" class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">
                                        {{old('description') ? old('description') : 
                                        (isset($client) ? $client->description : "")}}
                                    </textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Description brève du client.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:grid gap-2">
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
                                    <input type="text" step="0.01" name="adresse" id="adresse" 
                                    value='{{old('adresse') ? old('adresse') : 
                                    (isset($client) ? $client->adresse : "")}}'
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
        
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="pays" class="block text-sm font-medium text-gray-700">Pays</label>
                                    <input type="text" name="pays" id="pays" 
                                    value='{{old('pays') ? old('pays') : 
                                    (isset($client) ? $client->pays : "")}}'
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                    
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                                    <input type="text" name="ville" id="ville" 
                                    value='{{old('ville') ? old('ville') : 
                                    (isset($client) ? $client->ville : "")}}'
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
        
                                <div class="col-span-6">
                                    <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal</label>
                                    <input type="text" name="code_postal" id="code_postal" 
                                    value='{{old('code_postal') ? old('code_postal') : 
                                    (isset($client) ? $client->code_postal : "")}}'
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
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                                    <input type="email" name="email" id="email" 
                                    value='{{old('email') ? old('email') : 
                                    (isset($client) ? $client->email : "")}}'
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="site_web" class="block text-sm font-medium text-gray-700">Site Web</label>
                                    <input type="text" name="site_web" id="site_web" 
                                    value='{{old('site_web') ? old('site_web') : 
                                    (isset($client) ? $client->site_web : "")}}'
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6">
                                    <label for="devise" class="block text-sm font-medium text-gray-700">Devise</label>
                                    <input type="text" name="devise" id="devise" 
                                    value='{{old('devise') ? old('devise') : 
                                    (isset($client) ? $client->devise : "")}}'
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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

