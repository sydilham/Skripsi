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
        @stack('styles')
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative min-h-screen flex items-center justify-center bg-white overflow-hidden">
            <!-- Gambar Latar Transparan -->
            <img src="{{ asset('logo.png') }}" alt="Background Logo" class="absolute inset-auto w-auto h-full object-cover opacity-10 z-0">

            <!-- Animasi Partikel -->
            <div class="absolute inset-0 z-0 pointer-events-none">
                <div class="w-full h-full overflow-hidden">
                    <div class="particle"></div>
                    <div class="particle delay-1"></div>
                    <div class="particle delay-2"></div>
                    <div class="particle delay-3"></div>
                </div>
            </div>

            <!-- Slot konten -->
            <div class="relative z-10 w-full max-w-md px-6 py-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Style Animasi -->
        <style>
            .particle {
                position: absolute;
                width: 20px;
                height: 20px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                animation: float 10s infinite linear;
                top: 50%;
                left: 50%;
            }

            .particle.delay-1 { animation-delay: 2s; left: 30%; top: 40%; }
            .particle.delay-2 { animation-delay: 4s; left: 60%; top: 60%; }
            .particle.delay-3 { animation-delay: 6s; left: 80%; top: 30%; }

            @keyframes float {
                0% { transform: translateY(0) scale(1); opacity: 0.8; }
                50% { transform: translateY(-200px) scale(1.2); opacity: 0.2; }
                100% { transform: translateY(0) scale(1); opacity: 0.8; }
            }
        </style>

        @stack('scripts')
    </body>
</html>
