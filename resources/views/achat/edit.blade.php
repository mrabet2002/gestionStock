<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __("Créer un ordre d'chat") }}
                </div>
                <div class="py-1">
                        <a type="button" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo transition" >
                            <span class="mr-3">
                                Annuler
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </a>
                        <button type="submit" form="achatData" class="cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 btn-indigo active:bg-gray-50 transition">
                            <span class="mr-3">
                                Enregistrer
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                            </svg>
                        </button>
                    
                </div>
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
            <div class="containerc">
                <form action="{{route('achat.update', $achat)}}" method="POST" enctype="multipart/form-data" id="achatData">
                    @csrf
                    <div class="sm:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-6 overflow-hidden">
                            <div class="card shadow-md">
                                <div class="flex justify-start p-6 card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Aperçu</h3>
                                    </div>
                                </div><hr>
                                <div class="mt-5 md:mt-0 card-body">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="fournisseur" class="w-full block text-sm font-medium text-gray-700">Fournisseur</label>
                                            <div class="flex justify-between">
                                                <select id="fournisseur" name="fournisseur" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option selected disabled>Selectionner un fournisseur</option>
                                                    @if ($fournisseurs->count() == 0)
                                                        <option disabled>Désolés, nous ne trouvant pas de fournisseurs</option>
                                                    @else
                                                        @foreach ($fournisseurs as $fournisseur)
                                                            <option value="{{$fournisseur->id}}" {{$fournisseur->id == old('fournisseur') | $fournisseur->id == $achat->fournisseur->id ? "selected" : ""}}>
                                                                {{$fournisseur->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>                     
                                        
                                        <div class="col-span-6 ">
                                            <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                                            <div class="mt-1">
                                                <textarea id="description" name="description" rows="6" class="w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{old('description') ? old('description') : $achat->description}}</textarea>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Description brève du fournisseur.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="card shadow-md">
                                <div class="flex justify-start card-head">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900">Plus de détails</h3>
                                    </div>
                                </div><hr>
                                <div class="mt-5 md:mt-0 card-body">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label for="date_creation" class="block text-sm font-medium text-gray-700">Date de création</label>
                                            <input type="date" name="date_creation" id="date_creation" value="{{old('date_creation') ? old('date_creation') : $achat->created_at->format('Y-m-d')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="remiseAchat" class="block text-sm font-medium text-gray-700"> Remise Globale </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                <input type="text" name="remiseAchat" id="remiseAchat" value="{{old('remiseAchat') ? old('remiseAchat') : $achat->remise}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="devie" class="block text-sm font-medium text-gray-700">Devise</label>
                                            <input type="text" name="devise" id="devise" value="{{old('devise') ? old('devise') : $achat->devise}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                
                                        <div class="col-span-6">
                                            <label for="taxe" class="block text-sm font-medium text-gray-700">Taxe</label>
                                            <input type="number" step="0.01" name="taxe" id="taxe" value="{{old('taxe') ? old('taxe') : $achat->taxe}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="card shadow-md">
                                    <div class="flex justify-start card-head">
                                        <div class="px-4 sm:px-0">
                                            <h3 class="text-lg font-bold leading-6 text-gray-900">Produits</h3>
                                        </div>
                                    </div><hr>
                                    <div class="mt-5 md:mt-0 card-body">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-3">
                                            <thead class="text-xs text-white uppercase bg-blue-500 dark:bg-gray-700 dark:text-gray-400">
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
                                                    <th scope="col" class="px-6 py-3">
                                                        
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produits as $produit)
                                                    @if ($achat->produits->find($produit->id))
                                                        @php
                                                            $achat_produit = $achat->produits->find($produit->id);
                                                        @endphp
                                                    @else
                                                        @php
                                                            $achat_produit = null;
                                                        @endphp
                                                    @endif
                                                    <tr id="{{$produit->id}}" class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                        <input type="hidden" value="{{$produit->fournisseur->id}}">
                                                        <td class="produitCell px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                            <div class="col-span-6">
                                                                {{$produit->libele}}
                                                            </div>
                                                        </td>
                                                        <td class="prixCell px-6 py-4">
                                                            <div class="col-span-6">
                                                                <input type="number" step="0.01" name="lignesAchat[{{$produit->id}}][prix]" 
                                                                @if (old('lignesAchat.'.$produit->id.'.prix'))
                                                                    value="{{old('lignesAchat.'.$produit->id.'.prix')}}"
                                                                @else
                                                                    @if ($achat_produit)
                                                                        value="{{$achat_produit->pivot->prix}}"
                                                                    @else
                                                                        value="{{$produit->prix_initial}}"
                                                                    @endif
                                                                @endif
                                                                {{-- value="{{old('lignesAchat.'.$produit->id.'.prix') ? old('lignesAchat.'.$produit->id.'.prix') : 
                                                                $achat_produit ? $achat_produit->pivot->prix : $produit->prix_initial}}"  --}}
                                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                                onkeyup="calculatTotal(event)">
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                                <input type="number" name="lignesAchat[{{$produit->id}}][qte_demandee]" 
                                                                @if (old('lignesAchat.'.$produit->id.'.qte_demandee'))
                                                                    value="{{old('lignesAchat.'.$produit->id.'.qte_demandee')}}"
                                                                @else
                                                                    @if ($achat_produit)
                                                                        value="{{$achat_produit->pivot->qte_demandee}}"
                                                                    @else
                                                                        value="0"
                                                                    @endif
                                                                @endif
                                                                class="qte-input focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                                onkeyup="calculatTotal(event)"
                                                                onclick="resetValue(event)">
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> % </span>
                                                                <input type="number" name="lignesAchat[{{$produit->id}}][remise]" 
                                                                @if (old('lignesAchat.'.$produit->id.'.remise'))
                                                                    value="{{old('lignesAchat.'.$produit->id.'.remise')}}"
                                                                @else
                                                                    @if ($achat_produit)
                                                                        value="{{$achat_produit->pivot->remise}}"
                                                                    @else
                                                                        value="0"
                                                                    @endif
                                                                @endif
                                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                                onkeyup="calculatTotal(event)"
                                                                onclick="resetValue(event)">
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                                <input type="date" name="lignesAchat[{{$produit->id}}][date_expiration]" 
                                                                @if (old('lignesAchat.'.$produit->id.'.date_creation'))
                                                                    value="{{old('lignesAchat.'.$produit->id.'.date_creation')}}"
                                                                @else
                                                                    @if ($achat_produit)
                                                                        value="{{$achat_produit->pivot->date_creation}}"
                                                                    @else
                                                                        value=""
                                                                    @endif
                                                                @endif
                                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                                <input type="text" disabled name="lignesAchat[{{$produit->id}}][total]" 
                                                                @if (old('lignesAchat.'.$produit->id.'.total'))
                                                                    value="{{old('lignesAchat.'.$produit->id.'.total')}}"
                                                                @else
                                                                    @if ($achat_produit)
                                                                        value="{{$achat_produit->pivot->total}}"
                                                                    @else
                                                                        value="0"
                                                                    @endif
                                                                @endif
                                                                class="total-input focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                            </div>
                                                        </td>
                                                        <td class="py-4">
                                                            <button id="{{$produit->id}}" type="button" onclick="removeRow(event)" class="delete-product hover:bg-red-500 hover-text-white border rounded-md py-1 px-3 text-red-500 transition">
                                                                X
                                                            </button>
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
                                                <div class="card-head">
                                                    <h3 class="text-lg font-bold leading-6 text-gray-900">Details d'achat</h3>
                                                </div><hr>
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
                    </div>
                </form>
            </div>
    @endsection
    @section('script')
        <script src="/js/script.js"></script>
    @endsection
</x-app-layout>