<x-app-layout>
    <x-slot name="header">
        <h2 class="md:grid md:grid-cols-2 font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex items-center">
                {{ __('Stock') }}
            </div>
            <div class="text-right">
                <span class="rounded-md">
                    @if (auth()->user()->roles()->whereIn('slug', ['responsable-achat', 'acheteur'])->exists())
                        <a href="{{route('achat.index')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                            <span>
                                Ordre d'achat
                            </span>
                        </a>
                    @endif
                    @if (auth()->user()->roles()->whereIn('slug', ['responsable-vente', 'vendeur'])->exists())
                        <a href="{{route('vente.index')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                            <span>
                                Bons de commande
                            </span>
                        </a>
                    @endif
                </span>
            </div>
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
                            <input type="text" id="table-search" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items"
                            onkeyup="chercherLigne(event, 'body', 0)">
                        </div>
                    </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between items-center">
                                            <div class="flex align-center">
                                                Produit
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition h-fit">
                                                <svg onclick="trierString(event, 0, 'body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between items-center">
                                            <div class="flex align-center">
                                                Re??l
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition h-fit">
                                                <svg onclick="trierNum(event, 1, 'body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between items-center">
                                            <div class="flex align-center">
                                                Disponible
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition h-fit">
                                                <svg onclick="trierNum(event, 2, 'body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between items-center">
                                            <div class="flex align-center">
                                                Reserver
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition h-fit">
                                                <svg onclick="trierNum(event, 3, 'body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between items-center">
                                            <div class="flex align-center">
                                                Date d'expiration
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition h-fit">
                                                <svg onclick="trierString(event, 4, 'body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="body">
                                @if ($stocks->count() > 0)
                                    @foreach ($stocks as $stock)
                                        <tr class="cursor-pointer items-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{$stock->produit->libele}}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
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
                                            <td class="py-4">
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
                                                <h4 class="py-3 text-md font-bold">Aucun stock trouv??, il est possible d'effectuer un ordre d'achat pour en ajouter un.</h4>
                                                <a href="{{route('achat.index')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                                                    <span>
                                                        Ordre d'achat
                                                    </span>
                                                </a>
                                            @else
                                                <h4>Aucun stock trouv??</h4>
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
    @section('script')
        <script src="/js/script.js"></script>
    @endsection
</x-app-layout>