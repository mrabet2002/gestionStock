<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __("Information de l'achat") }}
                </div>
                @if ($achat->statut != 'Valoriser')
                    <div class="py-1 flex justiy-between items-center">
                        <div class="">
                            <form action="{{route('achat.edit',$achat->id)}}" id="modifierProd"></form>
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
                        <div class="px-2">
                            <button data-modal-toggle="supprimerProduit" class="inline-flex items-center btn btn-red transition">
                                <span class="mr-3">
                                    Annuler
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
    @section('content')
    
    <!-- Supprimer produit Modal -->
    <div id="supprimerProduit"  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-300 md:inset-0 h-full md:h-full">
        <div class="relative modal-container w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-1/2">
                <!-- Modal header -->
                <div class="flex justify-end p-2">
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="supprimerProduit" >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 pt-0 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Vous êtes sûr de supprimer ce produit ?
                    </h3>
                    <form action="{{route('achat.destroy',$achat->id)}}" method="post">
                        @csrf
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                            Oui
                        </button>
                        <button data-modal-toggle="supprimerProduit"  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Non
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <div class="containerc">
        <div class="md:grid md:grid-cols-3 gap-2">
            {{-- Resevoir produits --}}
            <div class="py-3">
                <div class="card-head">
                    @switch($achat->statut)
                        @case('En cours')
                            @php
                                $bg_color = 'bg-gray-500'
                            @endphp
                            @break
                        @case('Livrais')
                            @php
                                $bg_color = 'bg-orange-500'
                            @endphp
                            @break
                        @case('Valoriser')
                            @php
                                $bg_color = 'bg-green-500'
                            @endphp
                            @break
                        @default
                    @endswitch
                    <div class="{{$bg_color}} font-bold py-1 px-3 rounded text-white text-left w-full">
                        {{$achat->statut}}
                    </div>
                </div>
                <div class="card-body" style="padding: 0 20px">
                    <div class="bg-gray-500 text-white rounded" style=" margin:0 auto;">
                            
                            <div class="grid grid-cols-2 gap-0">
                                <div class="col px-6 py-4  text-sm font-bold uppercase text-left dark:text-white">
                                    Produit demander
                                </div>
                                <div class="col px-6 py-4 text-right dark:text-white">
                                    {{$achat->produits->count()}}
                                </div>
                                <div class="col-span-2 px-6 py-4 text-sm font-bold uppercase text-left dark:text-white">
                                    Quantite recu
                                </div>
                                <hr class="col-span-2" style="opacity: 0.5;">
                                    @foreach ($achat->produits as $produit)
                                        <div style="padding-left: 2.5rem" class="col py-2 flex align-center  text-sm uppercase text-left dark:text-white">
                                            {{$produit->libele}}
                                        </div>
                                        <div class="col px-6 py-2 text-left dark:text-white">
                                            @if ($achat->statut == 'En cours' || $achat->statut == 'Livrais')
                                                <form action="{{route('achat.recevoir_produits', $achat->id)}}" method="post" id="recevoirProduit">
                                                @csrf
                                                <input type="number" value="{{old('lignesAchat.'.$produit->id.'.qte_recu') ? old('lignesAchat.'.$produit->id.'.qte_recu') : $produit->pivot->qte_demandee}}" 
                                                name="lignesAchat[{{$produit->id}}][qte_recu]"  id={{'lignesAchat.'.$produit->id.'.qte_recu'}}
                                                class="w-3/4 focus:ring-indigo-500 text-gray-500 focus:border-indigo-500 rounded-md sm:text-sm border-gray-300">
                                            @else
                                                {{$produit->pivot->qte_recu}}
                                            @endif
                                            <span class="text-right">/{{$produit->pivot->qte_demandee}}</span>
                                        </div>
                                    @endforeach
                                <hr class="col-span-2" style="opacity: 0.5;">
                                <div class="col px-6 py-2  text-sm font-bold uppercase text-left dark:text-white">
                                    Date de reception
                                </div>
                                <div class="col px-6 py-2 text-left dark:text-white">
                                    @if ($achat->statut == 'En cours')
                                        <input type="date" value="{{old('date_reception') ? old('date_reception') : (new DateTime())->format('Y-m-d')}}" name="date_reception" id="date_reception" class="w-3/4 focus:ring-indigo-500 text-gray-500 focus:border-indigo-500 rounded-md sm:text-sm border-gray-300">
                                        </form>
                                    @else
                                        {{$achat->date_reception}}
                                    @endif
                                </div>
                            </div>
                            <hr style="opacity: 0.5;">
                            @if ($achat->statut == 'En cours')
                                <button form="recevoirProduit" type="submit" class="block btn btn-gray text-center transition w-full" style="font-weight: bolder">
                                    Recevoir les produits
                                </button>
                            @else
                                @if ($achat->statut == 'Livrais')
                                    <button form="recevoirProduit" type="submit" class="block btn btn-gray text-center transition w-full" style="font-weight: bolder">
                                        Valoriser
                                    </button>
                                </form>
                                @endif
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
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Fournisseur</th>
                                <td class="px-6 py-4 text-right w-full">{{$achat->fournisseur->name}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Date de Création</th>
                                @php
                                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra')
                                @endphp
                                <td class="px-6 py-4 text-right w-full">{{strftime('%d %B %Y', strtotime($achat->created_at))}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Taxe</th>
                                <td class="px-6 py-4 text-right w-full">{{$achat->taxe ? $achat->taxe : 0}}%</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Remise globale</th>
                                <td class="px-6 py-4 text-right w-full">{{$achat->remise ? $achat->remise : 0}}%</td>
                            </tr>
                            @if ($achat->devise)
                                <tr>
                                    <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">devise</th>
                                    <td class="px-6 py-4 text-right w-full">{{$achat->devise}}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                @if ($achat->description)
                    <div class="card shadow-md">
                        <div class="card-head">
                            Descripiton
                        </div>
                        <div class="card-body">
                            <p>{{$achat->description}}</p>
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
                                @foreach ($achat->produits as $produit)
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
                                                value="{{old('total')?old('total'):$achat->total}}" 
                                                style="border-bottom: 1px dashed gray;" type="number" step="0.01" name="total" value="{{old('total') ? old('total') : $achat->total}}" class="text-gray-500 border-0">
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