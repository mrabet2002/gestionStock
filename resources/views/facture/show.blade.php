<x-app-layout>
    @section('style')
        <style>
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-last-child(2) {
                font-weight: bold;
                white-space: nowrap;
                text-align: right
            }
            .invoice-box table tr.total td:last-child {
                text-align: right
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }

            /** RTL **/
            .invoice-box.rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }

            .invoice-box.rtl table {
                text-align: right;
            }

            .invoice-box.rtl table tr td:nth-child(2) {
                text-align: left;
            }
        </style>
    @endsection
    @php
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra')
    @endphp
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __('Fcture Numéro '.$facture->num_facture) }}
                </div>
                <div class="py-1">
                    <form action="{{route('facture.edit',$facture->id)}}" id="modifierProd"></form>
                    
                    <button type="submit" class="inline-flex items-center btn btn-blue transition" form="modifierProd">
                        <span class="mr-3">
                            Modifier
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </button>
                    <button data-modal-toggle="supprimerfacture" class="inline-flex items-center btn btn-red transition">
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
        </div>
    </x-slot>
    
    @section('content')
    <!-- Supprimer facture Modal -->
    <div id="supprimerfacture"  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-300 md:inset-0 h-full md:h-full">
        <div class="relative modal-container w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-1/2">
                <!-- Modal header -->
                <div class="flex justify-end p-2">
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="supprimerfacture" >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 pt-0 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Vous êtes sûr de supprimer ce facture ?
                    </h3>
                    <form action="{{route('facture.destroy',$facture->id)}}" method="post">
                        @csrf
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                            Oui
                        </button>
                        <button data-modal-toggle="supprimerfacture"  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Non
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="containerc mt-6 mb-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex align-center justify-center py-12 bg-gray-50 rounded-md">
                            <div class="welcome text-center">
                                <h1>{{$facture->ventes()->first()->client->name}}</h1>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Détails</h1>
                            <div class="py-2"><hr></div>
                            <table>
                                <tr>
                                    <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">N&#176; facture</th>
                                    <td class="px-6 py-4 text-right w-full"><a href="mailto:{{$facture->num_facture}}">{{$facture->num_facture}}</a></td>
                                </tr>
                                @if ($facture->date_echeance)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">date d'échéance</th>
                                        <td class="px-6 py-4 text-right w-full">{{strftime('%d %B %Y', strtotime($facture->date_echeance))}}</td>
                                    </tr>
                                @endif
                                @if ($facture->tva)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">TVA</th>
                                        <td class="px-6 py-4 text-right w-full">{{$facture->tva}} %</td>
                                    </tr>
                                @endif
                                @if ($facture->remise)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">remise</th>
                                        <td class="px-6 py-4 text-right w-full">{{$facture->remise}} %</td>
                                    </tr>
                                @endif
                                @if ($facture->montant_ht)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">HT</th>
                                        <td class="px-6 py-4 text-right w-full">{{$facture->montant_ht}} {{$facture->devise ? $facture->devise : 'DH'}}</td>
                                    </tr>
                                @endif
                                @if ($facture->total_ttc)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">TTC</th>
                                        <td class="px-6 py-4 text-right w-full">{{$facture->total_ttc}} {{$facture->devise ? $facture->devise : 'DH'}}</td>
                                    </tr>
                                @endif
                                @if ($facture->net_payer)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Net à payer</th>
                                        <td class="px-6 py-4 text-right w-full">{{$facture->net_payer}} {{$facture->devise ? $facture->devise : 'DH'}}</td>
                                    </tr>
                                @endif
                                @if ($facture->statut_paiment)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Statut</th>
                                        <td class="px-6 py-4 flex justify-end w-full">
                                            @switch($facture->statut_paiment)
                                                @case('non-payee')
                                                    <div class="bg-orange-500 font-bold py-1 px-3 rounded text-white text-center" style="width: fit-content">
                                                        Non Payée
                                                    </div>
                                                    @break
                                                @case('payee')
                                                    <div class="bg-green-500 font-bold py-1 px-3 rounded text-white text-center" style="width: fit-content">
                                                        Payée
                                                    </div>
                                                    @break
                                                @default
                                            @endswitch
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if ($facture->description)
                <div class="col">
                    <div class="bg-white shadow-lg rounded-lg p-6" style="height: fit-content">
                        <h1 class="text-xl font-bold">Description</h1>
                        <div class="py-2"><hr></div>
                        <p style="text-align: justify">{{$facture->description}}</p>
                    </div>
                </div>
            @endif
            @if ($facture->fichier_attacher)
                <div class="col">
                    <div class="bg-white shadow-lg rounded-lg p-6" style="height: fit-content">
                        <h1 class="text-xl font-bold">Fichier attacher</h1>
                        <div class="py-2"><hr></div>
                        <div class="welcome-img">
                            @if (pathinfo($facture->fichier_attacher)['extension'] == 'pdf')
                                <iframe width="100%" style="height: 100mm" csp="true" allowfullscreen="true" src="/uploads/{{$facture->fichier_attacher}}" frameborder="0"></iframe>
                            @else
                            <img width="100%" src="/uploads/{{$facture->fichier_attacher}}" class="rounded-md">
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-span-2">
                <div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg rounded-lg">
                    <div class="font-bold px-2 py-2 text-lg">
                        <h1>Produits</h1>
                    </div><hr>
                    <div class="relative overflow-x-auto">
                        <div class="py-3 px-3">
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
                                            ID
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
                                <tbody id="body">
                                    @foreach ($facture->ventes as $vente)
                                        <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 px-4">
                                                <div class="flex items-center">
                                                    @if ($vente->statut == 'Éditer' && auth()->user()->roles()->where('slug', 'expediteur')->exists())
                                                        <input form="validerVentes" id="{{$vente->id}}" value="{{$vente->id}}" name="ventes[{{$vente->id}}][checked]" type="checkbox" class="checkboxs w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    @endif    
                                                </div>
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{$vente->id}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$vente->created_at->format('d-m-Y')}}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($vente->statut == 'Éditer' && auth()->user()->roles()->where('slug', 'expediteur')->exists())
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
                                                @if ($vente->statut != 'Valider')
                                                    <a href="{{route('vente.edit',$vente->id)}}" class="px-3 edit-btn transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg rounded-lg">
                    <div class="font-bold px-2 py-2 text-lg">
                        <div class="flex justify-between items-center">
                            <h1 class="text-xl font-bold">Imprimer la facture</h1>
                            <button class="inline-flex items-center btn btn-orange transition" onclick="imprimerFacture()">
                                Imprimer
                            </button>
                        </div>
                    </div><hr>
                    <div class="relative overflow-x-auto">
                        <div id="invoice-box" class="py-3 px-3">
                            <div class="invoice-box">
                                <table cellpadding="0" cellspacing="0">
                                    <tr class="top">
                                        <td colspan="6">
                                            <table>
                                                <tr>
                                                    <td class="title">
                                                        <img class="w-16 h-16" src="/images/stock_logo.png" alt="">
                                                    </td>
                                                    <td>
                                                        Facture N&#176; {{$facture->num_facture}}<br />
                                                        Créé le : {{strftime('%d %B %Y', strtotime($facture->created_at))}}<br />
                                                        Échéance : {{strftime('%d %B %Y', strtotime($facture->date_echeance))}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                    
                                    <tr class="information">
                                        <td colspan="6">
                                            <table>
                                                <tr>
                                                    <td>
                                                        {{$client->adresse}}<br />
                                                        {{$client->pays}}<br />
                                                        {{$client->ville.', '.$client->code_postal}}
                                                    </td>
                                                    <td>
                                                        Client N&#176;{{' '.$client->num_client}}<br />
                                                        {{$client->name}}<br />
                                                        {{$client->email}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                    
                                    <tr class="heading">
                                        <td>Méthode de paiment</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            @switch($facture->methode_paiment)
                                                @case('espece')
                                                    Espèces
                                                    @break
                                                @case('cheque')
                                                    Chèque
                                                    @break
                                                @case('carte_credit')
                                                    Cartes de crédit
                                                    @break
                                            @endswitch
                                        </td>
                                    </tr>
                    
                                    <tr class="heading">
                                        <td>Article</td>
                                        <td style="text-align: center">Quantité</td>
                                        <td>Prix Unitaire HT</td>
                                        <td>Remise</td>
                                        <td>Total</td>
                                    </tr>
                                    @foreach ($facture->ventes as $vente)
                                        @foreach ($vente->produits as $produit)
                                        <tr class="item">
                                            <td>{{$produit->libele}}</td>
                                            <td style="text-align: center">{{$produit->pivot->qte_livrai}}</td>
                                            <td>{{$produit->pivot->prix}}</td>
                                            <td>{{$produit->pivot->remise ? $produit->pivot->remise : 0}} %</td>
                                            <td class="text-right whitespace-nowrap">{{$produit->pivot->total.' '.$client->devise}}</td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                    <tr class="heading">
                                        <td>TVA</td>
                                        <td></td>
                                        <td></td>
                                        <td>Remise</td>                                        
                                        <td>Total</td>
                                    </tr>
                                    @foreach ($facture->ventes as $vente)
                                        <tr class="item">
                                            <td>{{$vente->taxe ? $vente->taxe : 0}} %</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$vente->remise ? $vente->remise : 0}} %</td>
                                            <td class="text-right">{{$vente->total.' '.$client->devise}}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="total">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Montant HT : </td>
                                        <td>{{$facture->montant_ht.' '.$facture->devise}}</td>
                                    </tr>
                                    <tr class="total">
                                        <td><b>TVA : </b>{{$facture->tva ? $facture->tva : 0}} %</td>
                                        <td></td>
                                        <td></td>
                                        <td>Total TTC : </td>
                                        <td>{{$facture->total_ttc.' '.$facture->devise}}</td>
                                    </tr>
                                    <tr class="total">
                                        <td><b>Remise : </b>{{$facture->remise ? $facture->remise : 0}} %</td>
                                        <td></td>
                                        <td></td>
                                        <td>Net à payer : </td>
                                        <td>{{$facture->net_payer.' '.$facture->devise}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            function imprimerFacture() {
                let printwin = window.open("");
                printwin.document.write('<!DOCTYPE html><html>'+document.getElementsByTagName("head")[0].innerHTML+document.getElementById("invoice-box").innerHTML+'</html>');
                printwin.print();
            }
        </script>
    @endsection
</x-app-layout>