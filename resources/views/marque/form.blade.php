<div class="containerc">
    <form action="{{$route}}" method="POST" enctype="multipart/form-data" id="marqueData">
        @csrf
        <div class="sm:mt-0">
            <div class="md:grid md:grid-cols-2 overflow-hidde">
                <div class="card shadow-md col-span-2" style="height: fit-content">
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
                            <div class="col-span-6 ">
                                <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="6" 
                                    value="{{old('description')}}"
                                    class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Description brève du marque.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-md">
            <div class="flex justify-start card-head">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-bold leading-6 text-gray-900">Logo de la marque</h3>
                </div>
            </div><hr>
            <div class="mt-5 md:mt-0 card-body">
                <div class="grid grid-cols-6 gap-6">
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
    </form>
</div>