<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    @section('content')
    <div class=" py-2">
        @if (auth()->user()->roles()->where('slug', 'responsable-achat')->exists())
            <div class="grid md:grid-cols-2 gap-2">
                <div class="card shadow-md">
                    <div class="card-head font-bold">
                        Stocks
                    </div><hr>
                    <div class="card-body">
                        <h1 class="text-gray-500 py-2">Stocks en dessous de la quantité minimale</h1>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Produit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fournisseur
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reél
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Minimun
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        prix d'achat
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($stocks->count() > 0)
                                    @foreach ($stocks as $stock)
                                        <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{$stock->libele}}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{$stock->fournisseur}}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                @if ($stock->qte == $stock->min_stock)
                                                    @php
                                                        $color = 'orange'
                                                    @endphp
                                                @else
                                                    @php
                                                        $color = 'red'
                                                    @endphp
                                                @endif
                                                <div class="cursor-pointer bg-{{$color}}-500 hover:bg-{{$color}}-600 shadow font-bold py-1 px-3 rounded text-white text-center transition">
                                                    {{$stock->qte}}
                                                </div>
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                <div class="cursor-pointer bg-gray-400 hover:bg-gray-500 shadow font-bold py-1 px-3 rounded text-white text-center transition">
                                                    {{$stock->min_stock}}
                                                </div>
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{$stock->prix_achat}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                        <h1 class="text-gray-500 py-2 pt-6">Des produits n'existent pas en stock</h1>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        libelé
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fournisseur
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Catégorie
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        marque
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produitsNotInStock as $produit)
                                    <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{$produit->libele}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$produit->id_fournisseur ? $produit->fournisseur->name : ""}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$produit->categorie->libele}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$produit->id_marque ? $produit->marque->libele : ""}}
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($produitsNotInStockCount->raw_count > 5)
                                <tr class="text-center text-gray-600 bg-gray-100 hover:text-gray-500 transition underline decoration-solid">
                                    <td colspan="4" class="py-4">
                                        <a href="{{route('dashboard.prosuitsNotInStock')}}">Afficher tous les {{$produitsNotInStockCount->raw_count-5}} produits restant</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card shadow-md h-fit">
                    <div class="card-head font-bold">
                        Achats
                    </div><hr>
                    <div class="card-body">
                        {{$produitsNotInStockCount->raw_count}}
                    </div>
                </div>
                <div class="card shadow-md col-span-2">
                    <div class="card-head font-bold">
                        Fournisseurs
                    </div><hr>
                    <div class="card-body">
                        <h1 class="py-2 pt-6 text-gray-500">Le rapport total des quantité recu</h1>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Fournisseur
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        E-Mail
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Téléphon
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        rapport
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fournisseurs as $fournisseur)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{$fournisseur->name}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="mailto:{{$fournisseur->email}}">{{$fournisseur->email}}</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="tel:{{$fournisseur->tel}}">{{$fournisseur->tel}}</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$fournisseur->rapport_total}}%
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            
        @endif
    </div>
    
    @endsection
    @section('script')
        <script src="/js/script.js"></script>
    @endsection
</x-app-layout>
{{-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-jet-welcome />
                </div>
            </div>
        </div> --}}