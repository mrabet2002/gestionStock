<div class="containerc">
    <form action="{{$route}}" method="POST" enctype="multipart/form-data" id="categorieData">
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
                                <p class="mt-2 text-sm text-gray-500">Description brève du categorie.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>