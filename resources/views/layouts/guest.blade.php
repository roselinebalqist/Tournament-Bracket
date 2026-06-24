<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Manajemen Turnamen') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-100 antialiased bg-gray-950">
        <div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-[#020617] via-[#0b1120] to-[#111827]">

            <!-- Glow background -->
            <div class="absolute inset-0 -z-10">
                <div class="absolute top-[-120px] left-[-80px] w-[320px] h-[320px] bg-indigo-500/20 blur-3xl rounded-full"></div>
                <div class="absolute bottom-[-120px] right-[-60px] w-[340px] h-[340px] bg-purple-500/20 blur-3xl rounded-full"></div>
                <div class="absolute top-[30%] left-[45%] w-[220px] h-[220px] bg-cyan-400/10 blur-3xl rounded-full"></div>
            </div>

            <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">
                <a href="/" class="mb-8 text-center group">
                    <div class="mx-auto w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-3xl shadow-[0_0_35px_rgba(99,102,241,0.45)] group-hover:scale-105 transition">
                        🏆
                    </div>
                    <h1 class="mt-4 text-2xl font-black text-white">
                        Sistem Manajemen Turnamen
                    </h1>
                    <p class="text-sm text-gray-400 mt-1">
                        Login untuk masuk ke dashboard turnamen
                    </p>
                </a>

                <div class="w-full sm:max-w-md px-8 py-8 bg-white/10 backdrop-blur-xl border border-white/10 shadow-[0_0_50px_rgba(99,102,241,0.18)] rounded-3xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>