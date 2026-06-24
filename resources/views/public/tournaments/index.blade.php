<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Turnamen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">

    <header class="border-b border-gray-800 bg-gray-900/80 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">
                    Tournament Bracket
                </h1>
                <p class="text-sm text-gray-400">
                    Lihat daftar turnamen dan bracket pertandingan.
                </p>
            </div>

            <div class="flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/25 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <h2 class="text-3xl font-bold">
                Daftar Turnamen
            </h2>
            <p class="mt-2 text-gray-400">
                Pilih turnamen untuk melihat bracket publik.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($tournaments as $tournament)
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-white">
                                {{ $tournament->name }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-400">
                                {{ $tournament->game_name }}
                            </p>
                        </div>

                        <span class="text-xs px-3 py-1 rounded-full bg-gray-800 text-gray-300">
                            {{ str_replace('_', ' ', $tournament->status) }}
                        </span>
                    </div>

                    <p class="mt-4 text-sm text-gray-400 line-clamp-3">
                        {{ $tournament->description ?? 'Belum ada deskripsi.' }}
                    </p>

                    <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-gray-800 rounded-xl p-3">
                            <div class="text-gray-400">Peserta</div>
                            <div class="font-bold text-white">
                                {{ $tournament->approved_participants_count }}/{{ $tournament->max_participants }}
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl p-3">
                            <div class="text-gray-400">Match</div>
                            <div class="font-bold text-white">
                                {{ $tournament->matches_count }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('public.tournaments.bracket', $tournament) }}"
                           class="block text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Lihat Bracket
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-gray-900 border border-gray-800 rounded-2xl p-10 text-center text-gray-400">
                    Belum ada turnamen publik. Admin-nya mungkin masih sibuk nyusun bracket sambil overthinking.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $tournaments->links() }}
        </div>
    </main>

</body>
</html>