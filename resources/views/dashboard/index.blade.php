<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="containerc py-2">
            <div class="md:grid md:grid-cols-2 gap-2">
                <div class="col-span-2">
                    <div class="md:grid md:grid-cols-4 gap-2">
                        <div class="card cursor-pointer border-l-4 border-orange-400 shadow-md hover:shadow-xl duration-300">
                            <div class="card-body h-full flex items-center">
                                <div class="flex justify-between items-center w-full">
                                    <div class="font-bold uppercase">
                                        Nombre de vente
                                    </div>
                                    <div class="font-bold uppercase">
                                        {{$nbre_vente}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card cursor-pointer border-l-4 border-indigo-400 shadow-md hover:shadow-xl duration-300">
                            <div class="card-body h-full flex items-center">
                                <div class="flex justify-between items-center w-full">
                                    <div class="font-bold uppercase">
                                        Nombre d'achat
                                    </div>
                                    <div class="font-bold uppercase">
                                        {{$nbre_achat}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card cursor-pointer border-l-4 border-red-500 shadow-md hover:shadow-xl duration-300">
                            <div class="card-body h-full flex items-center">
                                <div class="flex justify-between items-center w-full">
                                    <div class="font-bold uppercase">
                                        Nombre de clients
                                    </div>
                                    <div class="font-bold uppercase">
                                        {{$nbreClients}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card cursor-pointer border-l-4 border-blue-400 shadow-md hover:shadow-xl duration-300">
                            <div class="card-body h-full flex items-center">
                                <div class="flex justify-between items-center w-full">
                                    <div class="font-bold uppercase">
                                        Nombre de fournisseur
                                    </div>
                                    <div class="font-bold uppercase">
                                        {{$nbreFournisseurs}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-md">
                    <div class="card-head font-bold">
                        <h1 class="text-gray-500 py-2">Moyenne mensuelle des achats</h1>
                    </div><hr>
                    <div class="card-body">
                        <ul class="hidden">
                            @for ($i = 1; $i <= 12; $i++)
                                @php
                                    $month = $i < 10 ? "0".$i : $i;
                                @endphp
                                <li class="moyenne-achats-par-mois" 
                                    value="{{isset($moyenneAchats[$month]) ? $moyenneAchats[$month] : ""}}">
                                </li>
                            @endfor
                        </ul>
                        <canvas class="p-10" id="moyenne-achats-chartBar"></canvas>
                    </div>
                </div>
                
                <div class="card shadow-md">
                    <div class="card-head font-bold">
                        <h1 class="text-gray-500 py-2">Moyenne mensuelle des ventes</h1>
                    </div><hr>
                    <div class="card-body">
                        <ul class="hidden">
                            @for ($i = 1; $i <= 12; $i++)
                                @php
                                    $month = $i < 10 ? "0".$i : $i;
                                @endphp
                                <li class="moyenne-ventes-par-mois" 
                                    value="{{isset($moyenneVentes[$month]) ? $moyenneVentes[$month] : ""}}">
                                </li>
                            @endfor
                        </ul>
                        <canvas class="p-10" id="moyenne-ventes-chartBar"></canvas>
                    </div>
                </div>
                <div class="card shadow-md">
                    <div class="card-head font-bold">
                        <h1 class="text-gray-500 py-2">Stocks en dessous de la quantité minimale</h1>
                    </div><hr>
                    <div class="card-body">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-400 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="flex items-center relative">
                                    <th scope="col" class="px-4 py-3 w-fit" style="width: 30%">
                                        Produit
                                    </th>
                                    <th scope="col" class="px-4 py-3 w-fit" style="width: 25%">
                                        Fournisseur
                                    </th>
                                    <th scope="col" class="px-4 py-3 w-fit" style="width: 25%">
                                        Qté disponible
                                    </th>
                                    <th scope="col" class="px-4 py-3 w-fit" style="width: 20%">
                                        Minimun
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="block overflow-y-auto" style="height: 300px">
                                @if ($stocks->count() > 0)
                                    @foreach ($stocks as $stock)
                                        <tr class="bg-gray-100 flex items-center border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row" class="px-4 py-4 font-medium text-gray-900 dark:text-white" style="width: 30%">
                                                {{$stock->libele}}
                                            </td>
                                            <td scope="row" class="px-4 py-4 font-medium text-gray-900 dark:text-white" style="width: 25%">
                                                {{$stock->fournisseur}}
                                            </td>
                                            <td scope="row" class="px-4 py-4 font-medium text-gray-900 dark:text-white" style="width: 25%">
                                                @if ($stock->qte_total == $stock->min_stock)
                                                    @php
                                                        $color = 'orange'
                                                    @endphp
                                                @else
                                                    @php
                                                        $color = 'red'
                                                    @endphp
                                                @endif
                                                <div class="cursor-pointer mx-auto w-fit bg-{{$color}}-500 hover:bg-{{$color}}-600 shadow font-bold py-1 px-3 rounded text-white text-center transition">
                                                    {{$stock->qte_total}}
                                                </div>
                                            </td>
                                            <td scope="row" class="px-4 py-4 font-medium text-gray-900 dark:text-white" style="width: 20%">
                                                <div class="cursor-pointer mx-auto w-fit bg-gray-400 hover:bg-gray-500 shadow font-bold py-1 px-3 rounded text-white text-center transition">
                                                    {{$stock->min_stock}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 text-center" colspan="8">
                                            <h4>Aucune donnée trouvé</h4>
                                        </td>
                                    </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card h-fit shadow-md col">
                    <div class="card-head font-bold">
                        <h1 class="py-2 text-gray-500">Le rapport total des quantité recu ce mois</h1>
                    </div><hr>
                    <div class="card-body">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-400 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="flex items-center relative">
                                    <th scope="col" class="px-4 py-3" style="width: 25%">
                                        Fournisseur
                                    </th>
                                    <th scope="col" class="px-4 py-3" style="width: 40%">
                                        E-Mail
                                    </th>
                                    <th scope="col" class="px-4 py-3" style="width: 20%">
                                        Téléphon
                                    </th>
                                    <th scope="col" class="px-4 py-3" style="width: 15%">
                                        rapport
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="block overflow-y-auto" style="height: 300px">
                                @if (!empty($fournisseurs))
                                    @foreach ($fournisseurs as $fournisseur)
                                        <tr class="bg-white flex items-center border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row" class="px-4 py-4 font-medium text-gray-900 dark:text-white" style="width: 25%">
                                                {{$fournisseur->name}}
                                            </td>
                                            <td class="px-4 py-4" style="width: 40%; word-wrap: break-word">
                                                <a href="mailto:{{$fournisseur->email}}">{{$fournisseur->email}}</a>
                                            </td>
                                            <td class="px-4 py-4" style="width: 20%;">
                                                <a href="tel:{{$fournisseur->tel}}">{{$fournisseur->tel}}</a>
                                            </td>
                                            <td class="px-4 py-4" style="width: 15%">
                                                {{$fournisseur->rapport_total}}%
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 text-center" colspan="8">
                                            <h4>Aucune donnée trouvé</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card shadow-md">
                    <div class="card-head font-bold">
                        <h1 class="text-gray-500 py-2">Des produits n'existent pas en stock</h1>
                    </div><hr>
                    <div class="card-body">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-400 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="flex w-full text-left relative">
                                    <th scope="col" class="px-6 py-3" style="width: 24%">
                                        libelé
                                    </th>
                                    <th scope="col" class="px-6 py-3" style="width: 24%">
                                        Fournisseur
                                    </th>
                                    <th scope="col" class="px-6 py-3" style="width: 24%">
                                        Catégorie
                                    </th>
                                    <th scope="col" class="px-6 py-3" style="width: 24%">
                                        marque
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="block overflow-y-auto" style="height: 300px;">
                                @foreach ($produitsNotInStock as $produit)
                                    <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                        <td scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                                            {{$produit->libele}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$produit->id_fournisseur ? $produit->fournisseur->name : ""}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$produit->categorie->libele}}
                                        </td>
                                        <td class="px-6 py-3">
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
                <div class="card shadow-md">
                    <div class="card-head font-bold">
                        <h1 class="text-gray-500 py-2">Quantité vendue par produit</h1>
                    </div><hr>
                    <div class="card-body">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-indigo-400 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="flex w-full text-left relative">
                                    <th scope="col" class="px-6 py-3" style="width: 50%">
                                        produit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center" style="width: 50%">
                                        Quantité vendue
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="block overflow-y-auto" style="height: 300px;">
                                @foreach ($qteVendueParProduit as $produit)
                                    <tr class="bg-gray-100 flex border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                        <td scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white" style="width: 50%">
                                            {{$produit->libele}}
                                        </td>
                                        <td class="px-6 py-3" style="width: 50%">
                                            <div class="cursor-pointer mx-auto w-fit bg-gray-400 hover:bg-gray-500 shadow font-bold py-1 px-3 rounded text-white text-center transition">
                                                {{$produit->qte_vendue}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    @endsection
    @section('script')
        <script src="/js/script.js"></script>
        <script src="/js/chart.js"></script>

        <!-- Chart bar -->
        <script>
            let moyenneAchats = document.querySelectorAll('.moyenne-achats-par-mois');
            moyenneAchats = Array.from(moyenneAchats).map(element => {return element.getAttribute('value')});

            let moyenneVentes = document.querySelectorAll('.moyenne-ventes-par-mois');
            moyenneVentes = Array.from(moyenneVentes).map(element => {return element.getAttribute('value')});

            let monthsList = [
                "janvier",
                "février",
                "Mars",
                "avril",
                "Mai",
                "juin",
            ]
            const date = new Date()
            if (date.getMonth() > 5) {
                monthsList = [
                    "juillet",
                    "août",
                    "septembre",
                    "octobre",
                    "novembre",
                    "décembre",
                ]
            }
            
            const moyenneAchatsBarChart = {
                labels: monthsList,
                datasets: [
                {
                    label: "Moyenne des achats",
                    backgroundColor: "rgb(251 146 60)",
                    borderColor: "rgb(251 146 60)",
                    data: moyenneAchats,
                },
                ],
            };

            const moyenneVentesBarChart = {
                labels: monthsList,
                datasets: [
                {
                    label: "Moyenne des ventes",
                    backgroundColor: "hsl(252, 82.9%, 67.8%)",
                    borderColor: "hsl(252, 82.9%, 67.8%)",
                    data: moyenneVentes,
                },
                ],
            };

            const configAchatsBarChart = {
                type: "bar",
                data: moyenneAchatsBarChart,
                options: {},
            };

            const configVentesBarChart = {
                type: "bar",
                data: moyenneVentesBarChart,
                options: {},
            };

            new Chart(
                document.getElementById("moyenne-achats-chartBar"),
                configAchatsBarChart
            );

            new Chart(
                document.getElementById("moyenne-ventes-chartBar"),
                configVentesBarChart
            );
        </script>
    @endsection
</x-app-layout>