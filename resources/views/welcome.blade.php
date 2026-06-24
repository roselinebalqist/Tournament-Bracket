<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Turnamen</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-white min-h-screen overflow-x-hidden">

    <div class="relative min-h-screen">
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-[-120px] left-[-100px] w-[380px] h-[380px] bg-indigo-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-120px] right-[-80px] w-[420px] h-[420px] bg-purple-500/20 rounded-full blur-3xl"></div>
            <div class="absolute top-[35%] left-[45%] w-[260px] h-[260px] bg-cyan-400/10 rounded-full blur-3xl"></div>
        </div>

        <nav class="border-b border-gray-800 bg-gray-900/70 backdrop-blur">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-2xl shadow-lg shadow-indigo-500/25">
                        🏆
                    </div>

                    <div>
                        <div class="font-black text-white leading-tight">
                            Tournament Bracket
                        </div>
                        <div class="text-xs text-gray-400">
                            Sistem Manajemen Turnamen
                        </div>
                    </div>
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('public.tournaments.index') }}"
                       class="hidden sm:inline-flex px-4 py-2 rounded-xl text-gray-300 hover:text-white hover:bg-gray-800 transition font-semibold">
                        Lihat Turnamen
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="px-5 py-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-500 hover:to-purple-500 transition font-bold shadow-lg shadow-indigo-500/25">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 rounded-xl text-gray-300 hover:text-white hover:bg-gray-800 transition font-semibold">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-5 py-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-500 hover:to-purple-500 transition font-bold shadow-lg shadow-indigo-500/25">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-sm font-bold">
                        ⚔️ Single Elimination Bracket System
                    </div>

                    <h1 class="mt-6 text-5xl md:text-7xl font-black leading-tight">
                        Kelola Turnamen,
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">
                            Generate Bracket
                        </span>
                        Otomatis.
                    </h1>

                    <p class="mt-6 text-lg text-gray-400 max-w-2xl leading-relaxed">
                        Aplikasi web untuk membuat turnamen, mengelola peserta,
                        approve pendaftaran, generate bracket, input skor, dan menampilkan
                        pemenang secara otomatis.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('public.tournaments.index') }}"
                           class="px-6 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-500 hover:to-purple-500 transition font-bold shadow-lg shadow-indigo-500/25 text-center">
                            Lihat Turnamen
                        </a>

                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="px-6 py-4 rounded-2xl bg-gray-800 text-white hover:bg-gray-700 transition font-bold text-center">
                                Masuk Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="px-6 py-4 rounded-2xl bg-gray-800 text-white hover:bg-gray-700 transition font-bold text-center">
                                Login Sekarang
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-2xl shadow-indigo-500/10">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-black text-white">
                                Live Bracket Preview
                            </h2>
                            <p class="text-sm text-gray-400 mt-1">
                                Alur sistem turnamen otomatis
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-300 border border-green-500/20 text-xs font-bold">
                            Ready
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-4">
                            <h3 class="font-bold text-gray-300">Round 1</h3>

                            <div class="bg-gray-950 border border-gray-800 rounded-2xl p-4">
                                <div class="text-sm text-gray-500 mb-3">Match 1</div>
                                <div class="space-y-2">
                                    <div class="bg-green-950 border border-green-700 rounded-xl px-3 py-2 flex justify-between">
                                        <span>Team A</span>
                                        <strong>2</strong>
                                    </div>
                                    <div class="bg-gray-900 border border-gray-800 rounded-xl px-3 py-2 flex justify-between">
                                        <span>Team B</span>
                                        <strong>1</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-950 border border-gray-800 rounded-2xl p-4">
                                <div class="text-sm text-gray-500 mb-3">Match 2</div>
                                <div class="space-y-2">
                                    <div class="bg-gray-900 border border-gray-800 rounded-xl px-3 py-2 flex justify-between">
                                        <span>Team C</span>
                                        <strong>0</strong>
                                    </div>
                                    <div class="bg-green-950 border border-green-700 rounded-xl px-3 py-2 flex justify-between">
                                        <span>Team D</span>
                                        <strong>3</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="font-bold text-gray-300">Semifinal</h3>

                            <div class="bg-gray-950 border border-gray-800 rounded-2xl p-4 mt-16">
                                <div class="text-sm text-gray-500 mb-3">Match 1</div>
                                <div class="space-y-2">
                                    <div class="bg-green-950 border border-green-700 rounded-xl px-3 py-2 flex justify-between">
                                        <span>Team A</span>
                                        <strong>2</strong>
                                    </div>
                                    <div class="bg-gray-900 border border-gray-800 rounded-xl px-3 py-2 flex justify-between">
                                        <span>Team D</span>
                                        <strong>1</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="font-bold text-gray-300">Final</h3>

                            <div class="bg-yellow-400 text-yellow-950 rounded-2xl p-5 mt-28">
                                <div class="text-sm font-bold">🏆 Champion</div>
                                <div class="mt-1 text-2xl font-black">
                                    Team A
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6">
                    <div class="text-4xl">👥</div>
                    <h3 class="mt-4 text-xl font-black text-white">
                        Kelola Peserta
                    </h3>
                    <p class="mt-2 text-gray-400">
                        User bisa daftar turnamen, admin bisa approve atau reject peserta.
                    </p>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6">
                    <div class="text-4xl">⚔️</div>
                    <h3 class="mt-4 text-xl font-black text-white">
                        Bracket Otomatis
                    </h3>
                    <p class="mt-2 text-gray-400">
                        Sistem membuat bracket single elimination dari peserta approved.
                    </p>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6">
                    <div class="text-4xl">🏆</div>
                    <h3 class="mt-4 text-xl font-black text-white">
                        Winner Otomatis
                    </h3>
                    <p class="mt-2 text-gray-400">
                        Admin input skor, pemenang otomatis naik ke babak berikutnya.
                    </p>
                </div>
            </section>
        </main>
    </div>

</body>
</html>