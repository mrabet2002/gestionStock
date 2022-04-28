<x-app-layout>
    <x-slot name="header">
        <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Achat') }}
            <span class="rounded-md">
                <a href="{{route('achat.create')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                    <span class="mr-3">
                        Créer
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </a>
            </span>
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
        <div class=" py-12">
            <div class="w-3/4 mx-auto px-6 py-12 bg-white border-0 shadow-lg rounded-lg">
                <div class="relative overflow-x-auto">
                    <div class="py-3 px-3">
                        <label for="table-search">Search</label>
                        <div class="relative mt-1">
                            <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-4 px-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fournisseur
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date de creation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date de reception
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Statut
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($achats->count() > 0)
                                    @foreach ($achats as $achat)
                                        <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 px-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    
                                                </div>
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{$achat->id}}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{$achat->fournisseur->name}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$achat->qte_disponible}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$achat->created_at}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$achat->date_reception}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$achat->total}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$achat->statut}}
                                            </td>
                                            <td class="py-4 flex justfy-between">
                                                <a href="{{route('achat.show',$achat->id)}}" class="px-3 text-indigo-500 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 text-center" colspan="9">
                                            <h4 class="py-3 text-md font-bold">Aucun achat trouvé, cliquez sur le boutant ci-dessous pour créer un.</h4>
                                            <a href="{{route('achat.create')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                                                <span class="mr-3">
                                                    Créer
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    @endsection
</x-app-layout>