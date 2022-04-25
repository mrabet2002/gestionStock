<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="/css/style.css">
        @yield('style')
        @livewireStyles
        <!-- Scripts -->
        <script src="{{ mix('/js/app.js') }}" defer></script>
        <script src="{{'/js/flowbite.js'}}" defer></script>
        
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{-- {{ $slot }} --}}
                @yield('content')
            </main>
        </div>

        @stack('modals')
        @yield('script')
        <script>
            function previewFile() {
                var preview = document.querySelector('.Image-preview');
                var previewPdf = document.querySelector('.pdf-preview');
                var file    = document.querySelector('.file-input').files[0];
                var reader  = new FileReader();
                
                if(file.type.match('image/jp.*') || file.type.match('image/png')) {
                    preview.style.display = "block";
                    reader.onloadend = function () {
                        preview.src = reader.result;
                    }
                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = "";
                    }
                    
                }else if(file.type.match('application/pdf')){
                    previewPdf.style.display = "block";
                    previewPdf.innerHTML = file.name;
                }else{
                    alert("Le type" + file.type + " et non accepté");
                }
                

                
            }
        </script>
        @livewireScripts
    </body>
</html>
