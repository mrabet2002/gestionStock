<x-app-layout>
    <x-slot name="header">
        <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex items-center">
                {{ __('Ventes') }}
            </div>
            @if(auth()->user()->roles()->whereIn('slug', ['responsable-vente', 'vendeur'])->exists())
                <span class="rounded-md">
                    <a href="{{route('vente.create')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
                        <span class="mr-3">
                            Créer
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </a>
                </span>
            @endif
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
        <div class=" py-12">
            <div class="w-3/4 mx-auto px-6 py-12 bg-white border-0 shadow-lg rounded-lg">
                <div class="relative overflow-x-auto">
                    <div class="py-3 px-3">
                        <div class="md:grid md:grid-cols-2 gap-6">
                            <div class="search">
                                <label for="table-search">Search</label>
                                <div class="relative mt-1">
                                    <input type="text" id="table-search" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Search for items"
                                    onkeyup="chercherLigne(event, 'ventes-body', 1)">
                                </div>
                            </div>
                            @if (auth()->user()->roles()->whereIn('slug', ['respensable-vente', 'expediteur'])->exists())
                                <div class="flex justify-end align-center">
                                    <form action="{{route('vente.validerVentes')}}" method="post" id="validerVentes">
                                        @csrf
                                        <button class="btn btn-blue w-fit" form="validerVentes">
                                            Valider
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-4 px-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox" 
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            onclick="checkAllToggel(event)">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-between">
                                            <div class="flex align-center">
                                                Client
                                            </div>
                                            <div class="cursor-pointer rounded ordre-icone transition">
                                                <svg onclick="trierString(event, 1, 'ventes-body')" ordre="desc" id="trie-icone" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="cursor-pointer bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date de creation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date de livraison
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
                            <tbody class="ventes-body">
                                @if ($ventes->count() > 0)
                                    @foreach ($ventes as $vente)
                                        <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 px-4">
                                                <div class="flex items-center">
                                                    @if ($vente->statut == 'Éditer' && auth()->user()->roles()->whereIn('slug', ['respensable-vente', 'expediteur'])->exists())
                                                        <input form="validerVentes" id="{{$vente->id}}" value="{{$vente->id}}" name="ventes[{{$vente->id}}][checked]" type="checkbox" class="checkboxs w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    @endif    
                                                </div>
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{$vente->client->name}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$vente->created_at->format('d-m-Y')}}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($vente->statut == 'Éditer' && auth()->user()->roles()->whereIn('slug', ['respensable-vente', 'expediteur'])->exists())
                                                    <form action="{{route('vente.validerVente', $vente->id)}}" method="post" id="validerVente">
                                                        @csrf
                                                        <input form="validerVentes" type="date" value="{{old('date_livraison') ? old('date_livraison') : (new DateTime())->format('Y-m-d')}}" name="ventes[{{$vente->id}}][date_livraison]" id="date_livraison_{{$vente->id}}" class="focus:ring-indigo-500 w-full text-gray-500 focus:border-indigo-500 rounded-md sm:text-sm border-gray-300">
                                                    </form>
                                                @else
                                                    {{$vente->date_livraison}}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$vente->total}}
                                            </td>
                                            <td class="px-6 py-4">
                                                @switch($vente->statut)
                                                    @case('Éditer')
                                                        <div class="bg-orange-500 font-bold py-1 px-3 rounded text-white text-center" style="width: fit-content">
                                                            Éditer
                                                        </div>
                                                        @break
                                                    @case('Valider')
                                                        <div class="bg-green-500 font-bold py-1 px-3 rounded text-white text-center" style="width: fit-content">
                                                            Valider
                                                        </div>
                                                        @break
                                                    @default
                                                        
                                                @endswitch
                                            </td>
                                            <td class="px-6 flex justfy-between" style="padding: 1.5rem 0">
                                                <a href="{{route('vente.show',$vente->id)}}" class="px-3 text-indigo-500 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </a>
                                                @if ($vente->statut != 'Valider' && auth()->user()->roles()->whereIn('slug', ['respensable-vente', 'vendeur'])->exists())
                                                    <a href="{{route('vente.edit',$vente->id)}}" class="px-3 edit-btn transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 text-center" colspan="9">
                                            <h4 class="py-3 text-md font-bold">Aucune vente trouvé, cliquez sur le boutant ci-dessous pour créer un.</h4>
                                            <a href="{{route('vente.create')}}" type="button" class="btn btn-indigo inline-flex items-center transition">
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
    
    @section('script')
        <script src="/js/script.js"></script>
    @endsection
</x-app-layout>