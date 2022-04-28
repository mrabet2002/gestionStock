<x-app-layout>
    <x-slot name="header">
        <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stock') }}
            <span class="rounded-md">
                @if (auth()->user()->roles()->where('slug', 'responsable-achat')->exists())
                    <a href="{{route('stock.create')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                        <span>
                            Ordre d'achat
                        </span>
                    </a>
                @endif
                @if (auth()->user()->roles()->where('slug', 'vendeur')->exists())
                    <a href="{{route('achat.index')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                        <span>
                            Bons de commande
                        </span>
                    </a>
                @endif
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
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Produit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reél
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Disponible
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reserver
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date d'expiration
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($stocks->count() > 0)
                                    @foreach ($stocks as $stock)
                                        <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 px-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    
                                                </div>
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{$stock->produit->libele}}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{$stock->qte}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$stock->qte_disponible}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$stock->qte - $stock->qte_disponible}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$stock->date_expiration}}
                                            </td>
                                            <td class="py-4 flex justfy-between">
                                                <a href="{{route('stock.show',$stock->id)}}" class="px-3 text-indigo-500 transition">
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
                                        <td class="px-6 py-4 text-center" colspan="8">
                                            @if (auth()->user()->roles()->where('slug', 'responsable-achat')->exists())
                                                <h4 class="py-3 text-md font-bold">Aucun stock trouvé, il est possible d'effectuer un ordre d'achat pour en ajouter un.</h4>
                                                <a href="{{route('achat.index')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                                                    <span>
                                                        Ordre d'achat
                                                    </span>
                                                </a>
                                            @else
                                                <h4>Aucun stock trouvé</h4>
                                            @endif
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