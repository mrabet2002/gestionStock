<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="sm:flex justify-between">
                <div class="py-2">
                    {{ __($fournisseur->name) }}
                </div>
                <div class="py-1">
                        <form action="{{route('fournisseur.edit',$fournisseur->id)}}" id="modifierProd"></form>
                        <button type="submit" class="inline-flex items-center btn btn-blue transition" form="modifierProd">
                            <span class="mr-3">
                                Modifier
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                        <button data-modal-toggle="supprimerfournisseur" class="inline-flex items-center btn btn-red transition">
                            <span class="mr-3">
                                Supprimer
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <!-- Supprimer fournisseur Modal -->
                        <div id="supprimerfournisseur"  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-full md:h-full">
                            <div class="relative modal-container w-full max-w-md h-full md:h-auto">
                                <!-- Modal content -->
                                <div class="relative sm-modal-content bg-white rounded-lg shadow dark:bg-gray-700 md:w-1/2">
                                    <!-- Modal header -->
                                    <div class="flex justify-end p-2">
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="supprimerfournisseur" >
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 pt-0 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 dark:text-gray-200" width="10%" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">
                                            Vous êtes sûr de supprimer ce fournisseur ?
                                        </h3>
                                        <form action="{{route('fournisseur.destroy',$fournisseur->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center mr-2">
                                                Oui
                                            </button>
                                            <button data-modal-toggle="supprimerfournisseur"  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-2 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Non
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </x-slot>
    @section('content')
    <div class="containerc mt-6 mb-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex align-center justify-center py-12 bg-gray-50 rounded-md">
                            <div class="welcome text-center">
                                <h1>{{$fournisseur->name}}</h1>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Détails</h1>
                            <div class="py-2"><hr></div>
                            <table>
                                @if ($fournisseur->email)
                                <tr>
                                    <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">E-mail</th>
                                    <td class="px-6 py-4 text-right w-full"><a href="mailto:{{$fournisseur->email}}">{{$fournisseur->email}}</a></td>
                                </tr>
                                @endif
                                @if ($fournisseur->tel)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Téléphone</th>
                                        <td class="px-6 py-4 text-right w-full"><a href="tel:{{$fournisseur->tel}}">{{$fournisseur->tel}}</a></td>
                                    </tr>
                                @endif
                                @if ($fournisseur->adresse)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Adresse</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->adresse}} DH</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->pays)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Pays</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->pays}}</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->ville)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Ville</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->ville}}</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->code_postal)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Code postal</th>
                                        <td class="px-6 py-4 text-right w-full">{{$fournisseur->code_postal}}</td>
                                    </tr>
                                @endif
                                @if ($fournisseur->site_web)
                                    <tr>
                                        <th class="px-6 py-4 text-sm uppercase text-left text-gray-900 dark:text-white whitespace-nowrap">Site Web</th>
                                        <td class="px-6 py-4 text-right w-full"><a href="{{$fournisseur->site_web}}" target="_blank">{{$fournisseur->site_web}}</a></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if ($fournisseur->description)
                <div class="col">
                    <div class="bg-white shadow-lg rounded-lg p-6" style="height: fit-content">
                        <h1 class="text-xl font-bold">Description</h1>
                        <div class="py-2"><hr></div>
                        <p style="text-align: justify">{{$fournisseur->description}}</p>
                    </div>
                </div>
            @endif
            @if ($fournisseur->fichier_attacher)
                <div class="col">
                    <div class="bg-white shadow-lg rounded-lg p-6" style="height: fit-content">
                        <h1 class="text-xl font-bold">Fichier attacher</h1>
                        <div class="py-2"><hr></div>
                        <div class="welcome-img">
                            <iframe width="100%" style="height: 100mm" csp="true" allowfullscreen="true" src="/uploads/{{$fournisseur->fichier_attacher}}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            @endif
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