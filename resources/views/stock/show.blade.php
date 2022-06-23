<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __($stock->produit->libele . ' stock') }}
                </div>
                <div class="py-1">
                    <button data-modal-toggle="supprimerProduit" class="inline-flex items-center btn btn-red transition">
                        <span class="mr-3">
                            Annuler
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-x-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </x-slot>
    @section('content')
        <!-- Supprimer produit Modal -->
        <div id="supprimerProduit" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-200 md:inset-0 h-full md:h-full">
            <div class="relative modal-container w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-1/2">
                    <!-- Modal header -->
                    <div class="flex justify-end p-2">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-toggle="supprimerProduit">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 pt-0 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Vous êtes sûr de supprimer ce produit ?
                        </h3>
                        <form action="{{ route('produit.destroy', $stock->produit->id) }}" method="post">
                            @csrf
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                                Oui
                            </button>
                            <button data-modal-toggle="supprimerProduit" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Non
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="containerc mt-6 mb-6">
            <div class="md:grid md:grid-cols-3 gap-2">
                <div class="card cursor-pointer border shadow-md hover:shadow-xl duration-300">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div class="font-bold uppercase">
                                Quantité Reel
                            </div>
                            <div class="font-bold uppercase">
                                {{ $stock->qte }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card cursor-pointer border shadow-md hover:shadow-xl duration-300">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div class="font-bold uppercase">
                                Quantité disponible
                            </div>
                            <div class="font-bold uppercase">
                                {{ $stock->qte_disponible }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card cursor-pointer border shadow-md hover:shadow-xl duration-300">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div class="font-bold uppercase">
                                Date d'expiration
                            </div>
                            <div class="font-bold uppercase">
                                {{ $stock->date_expiration }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex align-center justify-center py-12 bg-gray-50 rounded-md">
                        <div class="welcome text-center">
                            <h1>{{ $stock->produit->libele }}</h1>
                            <p class="hidden code_barre">{{ $stock->produit->code_barre }}</p>
                            <svg id="barcode" class="mx-auto"></svg>
                        </div>
                    </div>
                    <div class="welcome-img">
                        @if ($stock->produit->image)
                            <img width="100%" src="/uploads/{{ $stock->produit->image }}" class="rounded-md"
                                alt="{{ $stock->produit->libele }}">
                        @else
                            <img width="100%" src="/images/image_placeholder.png" class="rounded-md"
                                alt="Aucune image pour ce produit">
                        @endif
                    </div>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6 mt-6">
                @if ($stock->produit->description)
                    <div class="bg-white shadow-lg rounded-lg p-6" style="height: fit-content">
                        <h1 class="text-xl font-bold">Description</h1>
                        <div class="py-2">
                            <hr>
                        </div>
                        <p style="text-align: justify">{{ $stock->produit->description }}</p>
                    </div>
                @endif
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h1 class="text-xl font-bold">Détails</h1>
                    <div class="py-2">
                        <hr>
                    </div>
                    <table>
                        @if ($stock->produit->categorie->libele)
                            <tr>
                                <th
                                    class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">
                                    Categorie</th>
                                <td class="px-6 py-4 text-right w-full">{{ $stock->produit->categorie->libele }}</td>
                            </tr>
                        @endif
                        @if ($stock->produit->marque->libele)
                            <tr>
                                <th
                                    class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">
                                    Marque</th>
                                <td class="px-6 py-4 text-right w-full">{{ $stock->produit->marque->libele }}</td>
                            </tr>
                        @endif
                        @if ($stock->produit->fournisseur)
                            <tr>
                                <th
                                    class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">
                                    Fournisseur</th>
                                <td class="px-6 py-4 text-right w-full">{{ $stock->produit->fournisseur->name }}</td>
                            </tr>
                        @endif
                        @if ($stock->prix_achat)
                            <tr>
                                <th
                                    class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">
                                    Prix d'achat</th>
                                <td class="px-6 py-4 text-right w-full">{{ $stock->prix_achat }} DH</td>
                            </tr>
                        @endif
                        @if ($stock->produit->zone)
                            <tr>
                                <th
                                    class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">
                                    Zone</th>
                                <td class="px-6 py-4 text-right w-full">{{ $stock->produit->zone }}</td>
                            </tr>
                        @endif
                        @if ($stock->produit->poids)
                            <tr>
                                <th
                                    class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">
                                    Poids</th>
                                <td class="px-6 py-4 text-right w-full">{{ $stock->produit->poids }}</td>
                            </tr>
                        @endif
                        @if ($stock->produit->min_stock)
                            <tr>
                                <th
                                    class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">
                                    Nive de stock minimal</th>
                                <td class="px-6 py-4 text-right w-full">{{ $stock->produit->min_stock }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

        </div>
    @endsection
    @section('script')
        <script src="/js/JsBarcode.all.min.js"></script>
        <script>
            let code_barre = document.querySelector('.code_barre').innerHTML;
            JsBarcode("#barcode", code_barre);
        </script>
    @endsection
</x-app-layout>
