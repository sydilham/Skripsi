<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <div class="flex-grow flex items-center justify-center">
        <div class="max-w-3xl w-full text-center p-6 bg-white shadow-lg rounded-lg">
            <img src="{{ asset('logo.png') }}" alt="Logo Perusahaan" class="w-32 mx-auto mb-4">

            <h1 class="text-2xl font-bold text-gray-800">Sistem Penghitungan dan Pelaporan Dokumen Pajak</h1>
            <p class="text-gray-500 mt-1 text-sm">Aplikasi ini dirancang untuk mempermudah pengelolaan laporan pajak
            secara efisien dan akurat.</p>

            <!-- Informasi Tambahan -->
            <div class="mt-4 text-sm text-gray-600">
                <p class="font-semibold">SD NEGERI CARINGIN I</p>
                <p>20604254</p>
                <p>Jl.Lingkar Caringin Ds.Caringin</p>
                <p>08136288xxx | <a href="mailto:caringinsdnegeri@gmail.com"
                        class="text-blue-600 hover:underline">caringinsdnegeri@gmail.com</a></p>
            </div>

            <div class="mt-6 flex justify-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-4 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100">
                            Dashboard
                        </a>
                    @else

                            <div class="relative inline-flex  group">
                                <div
                                    class="absolute transitiona-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-[#44BCFF] via-[#FF44EC] to-[#FF675E] rounded-xl blur-lg group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200 animate-tilt">
                                </div>
                                <a href="{{ route('login') }}"
                                    class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gray-900 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                                    role="button">Login
                                </a>
                            </div>
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
    <footer>
<marquee behavior="" direction="">© {{ date('Y') }} SD NEGERI CARINGIN I || Syyd</marquee>
    {{-- <footer class="mt-6 text-center text-sm text-gray-500">
        <p>© {{ date('Y') }} Kantor Konsultan Pajak Suwandi Sudarsono & Rekan. All rights reserved.</p>
        <p>Dibuat oleh Muhammad Andrian Bhakti Maulana & Delia Saniar Komalasari</p>
        <p>Universitas Nusantara PGRI Kediri</p>
    </footer> --}}
</footer>
</body>

</html>
