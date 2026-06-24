<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-black text-white">
            User Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <div class="bg-gray-900 border border-gray-800 shadow-2xl shadow-indigo-500/10 rounded-3xl p-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black text-white">
                        Halo Peserta 🎮
                    </h1>

                    <p class="mt-2 text-gray-400">
                        Buat tim, daftar turnamen, dan pantau bracket pertandingan.
                    </p>
                </div>

                <a href="{{ route('user.tournaments.index') }}"
                   class="px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl hover:from-indigo-500 hover:to-purple-500 shadow-lg shadow-indigo-500/25 transition font-bold hover:-translate-y-1 active:scale-95">
                    Lihat Turnamen
                </a>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-5">
                <a href="{{ route('user.tournaments.index') }}"
                   class="group p-6 rounded-3xl bg-gray-950 border border-indigo-500/20 hover:border-indigo-400/60 shadow-xl hover:shadow-indigo-500/20 transition duration-300 hover:-translate-y-2 active:scale-95">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-3xl shadow-lg shadow-indigo-500/30">
                        🏆
                    </div>

                    <h3 class="mt-5 text-xl font-black text-white group-hover:text-indigo-300 transition">
                        Daftar Turnamen
                    </h3>

                    <p class="text-sm text-gray-400 mt-2">
                        Lihat turnamen yang tersedia.
                    </p>
                </a>

                <a href="{{ route('user.teams.index') }}"
                   class="group p-6 rounded-3xl bg-gray-950 border border-cyan-500/20 hover:border-cyan-400/60 shadow-xl hover:shadow-cyan-500/20 transition duration-300 hover:-translate-y-2 active:scale-95">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-3xl shadow-lg shadow-cyan-500/30">
                        👥
                    </div>

                    <h3 class="mt-5 text-xl font-black text-white group-hover:text-cyan-300 transition">
                        Tim Saya
                    </h3>

                    <p class="text-sm text-gray-400 mt-2">
                        Kelola tim atau player milik anda.
                    </p>
                </a>

                <a href="{{ route('public.tournaments.index') }}"
                   class="group p-6 rounded-3xl bg-gray-950 border border-emerald-500/20 hover:border-emerald-400/60 shadow-xl hover:shadow-emerald-500/20 transition duration-300 hover:-translate-y-2 active:scale-95">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-3xl shadow-lg shadow-emerald-500/30">
                        ⚔️
                    </div>

                    <h3 class="mt-5 text-xl font-black text-white group-hover:text-emerald-300 transition">
                        Bracket Publik
                    </h3>

                    <p class="text-sm text-gray-400 mt-2">
                        Pantau hasil pertandingan terbaru.
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>