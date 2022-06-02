<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __("Information de la vente") }}
                </div>
                @if ($vente->statut != 'Valoriser')
                    <div class="py-1">
                        <form action="{{route('vente.edit',$vente->id)}}" id="modifierProd"></form>
                        <button type="submit" class="inline-flex items-center btn btn-blue transition" form="modifierProd">
                            <span class="mr-3">
                                Modifier
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
    @section('content')
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
    @if (session()->has('success'))
            <div class="success-container">
                <div class="success bg-red-100 border px-3 py-3 rounded-lg" role="alert">
                    <svg class="dark:text-gray-200" width="5%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="px-3">{{ session()->get('success') }}</span>
                </div>
            </div>
        @endif
    <div class="containerc">
        <div class="md:grid md:grid-cols-3 gap-2">
            {{-- Resevoir produits --}}
            <div class="py-3">
                <div class="card-head">
                    @switch($vente->statut)
                        @case('Éditer')
                            @php
                                $bg_color = 'bg-orange-500'
                            @endphp
                            @break
                        @case('Valider')
                            @php
                                $bg_color = 'bg-green-500'
                            @endphp
                            @break
                        @default
                    @endswitch
                    <div class="{{$bg_color}} font-bold py-1 px-3 rounded text-white text-left w-full">
                        {{$vente->statut}}
                    </div>
                </div>
                <div class="card-body" style="padding: 0 20px">
                    <div class="bg-gray-500 text-white rounded">
                            
                            <div class="md:grid md:grid-cols-2 gap-2 w-full">
                                <div class="col px-6 py-4  text-sm font-bold uppercase text-left dark:text-white">
                                    Produit demander
                                </div>
                                <div class="col px-6 py-4 text-right dark:text-white">
                                    {{$vente->produits->count()}}
                                </div>
                                <div class="col-span-2 px-6 py-4 text-sm font-bold uppercase text-left dark:text-white">
                                    Quantite livrai
                                </div>
                                <hr class="col-span-2" style="opacity: 0.5;">
                                    @foreach ($vente->produits as $produit)
                                        <div style="padding-left: 2.5rem" class="col py-2 flex align-center  text-sm uppercase text-left dark:text-white">
                                            {{$produit->libele}}
                                        </div>
                                        <div class="col px-6 py-2 justify-end flex items-center dark:text-white">
                                            <span class="text-right">{{$produit->pivot->qte_livrai."/".$produit->pivot->qte_demandee}}</span>
                                        </div>
                                    @endforeach
                                <hr class="col-span-2" style="opacity: 0.5;">
                                <div class="col px-6 py-2  text-sm font-bold uppercase text-left dark:text-white">
                                    Date de livraison
                                </div>
                                <div class="col px-6 py-2 text-left dark:text-white">
                                    @if ($vente->statut == 'Éditer')
                                        <form action="{{route('vente.validerVente', $vente->id)}}" method="post" id="validerVente">
                                            @csrf
                                            <input type="date" value="{{old('date_livraison') ? old('date_livraison') : (new DateTime())->format('Y-m-d')}}" name="date_livraison" id="date_livraison" class="focus:ring-indigo-500 w-full text-gray-500 focus:border-indigo-500 rounded-md sm:text-sm border-gray-300">
                                        </form>
                                    @else
                                        {{$vente->date_livraison}}
                                    @endif
                                </div>
                            </div>
                            <hr style="opacity: 0.5;">
                            @if ($vente->statut == 'Éditer' && auth()->user()->roles()->where('slug', 'expediteur')->exists())
                                <button form="validerVente" type="submit" class="block btn btn-gray text-center transition w-full" style="font-weight: bolder">
                                    Valider la vente
                                </button>
                            @endif
                    </div>
                </div>
            </div>
            {{-- Détails --}}
            <div class="col-span-2">

                <div class="card shadow-md">
                    <div class="card-head">
                        <h1 class="text-xl font-bold">
                            Détails
                        </h1>
                    </div><hr>
                    <div class="card-body">
                        <table class="text-gray-500">
                            <tr>
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Client</th>
                                <td class="px-6 py-4 text-right w-full">{{$vente->client->name}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Date de Création</th>
                                <td class="px-6 py-4 text-right w-full">{{date('d F Y', strtotime($vente->created_at))}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Taxe</th>
                                <td class="px-6 py-4 text-right w-full">{{$vente->taxe ? $vente->taxe : 0}} DH</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Remise globale</th>
                                <td class="px-6 py-4 text-right w-full">{{$vente->remise ? $vente->remise : 0}}%</td>
                            </tr>
                            @if ($vente->devise)
                                <tr>
                                    <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">devise</th>
                                    <td class="px-6 py-4 text-right w-full">{{$vente->devise}}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                @if ($vente->description)
                    <div class="card shadow-md">
                        <div class="card-head">
                            Descripiton
                        </div>
                        <div class="card-body">
                            <p>{{$vente->description}}</p>
                        </div>
                    </div>
                @endif
                <div class="card shadow-md">
                    <div class="flex justify-start card-head">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-bold leading-6 text-gray-900">Produits</h3>
                        </div>
                    </div><hr>
                    <div class="mt-5 md:mt-0 card-body">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-3">
                            <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Produit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Prix
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Qté
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Remise
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date d'éxpiration
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vente->produits as $produit)
                                    <tr id="{{$produit->id}}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="produitCell px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <div class="col-span-6">
                                                {{$produit->libele}}
                                            </div>
                                        </td>
                                        <td class="prixCell px-6 py-4">
                                            <div class="col-span-6">
                                                {{$produit->pivot->prix}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                {{$produit->pivot->qte_demandee}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                {{$produit->pivot->remise}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                {{$produit->pivot->date_expiration}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                {{$produit->pivot->total}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr id="noRowFound" style="display: none" class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center" colspan="8">
                                        <h4 class="py-3 text-md font-bold">Aucun produit trouver pour ce fournisseur.</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="flex justify-end">
                            <div class="card shadow-md border w-1/2 mt-3">
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Total</th>
                                            <td class="relative px-6 py-4 text-right w-full">
                                                <input id="prix-total" disabled type="text" 
                                                value="{{old('total')?old('total'):$vente->total}}" 
                                                style="border-bottom: 1px dashed gray;" type="number" step="0.01" name="total" value="{{old('total') ? old('total') : $vente->total}}" class="text-gray-500 border-0">
                                                <span style="top: 1.5rem; right: 1.5rem;" class="absolute block inline-flex items-center px-3 border-0 text-gray-500 text-sm">DH</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>