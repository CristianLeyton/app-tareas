<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">

                    <div class="max-w-7xl mx-auto py-2 sm:py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <div name="Titulo"> {{ $header }} </div>
                        <div>
                        <div class="sm:hidden flex">
                            <div class="flex gap-2">
                                <x-responsive-nav-item href="{{ route('inicio') }}" :active="request()->routeIs('inicio')">
                                    <i class='bx bx-notepad text-lg'></i>
                                </x-responsive-nav-item>
                                <x-responsive-nav-item href="{{ url('completadas') }}" :active="request()->routeIs('completadas')">
                                    <i class='bx bx-calendar-check text-lg'></i>
                                </x-responsive-nav-item>
                                <x-responsive-nav-item href="{{ url('etiquetas') }}" :active="request()->routeIs('etiquetas')">
                                    <i class='bx bxs-bookmarks text-lg'></i>
                                </x-responsive-nav-item>
                            </div> 
                        </div>
                        </div>
                    </div> 

                    </div>
                    
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        
        @livewireScripts
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <script src="{{ asset('scripts/taskCompleted.js') }}"></script>
    </body>
</html>
