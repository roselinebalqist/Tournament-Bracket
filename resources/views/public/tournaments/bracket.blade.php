<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tournament->name }} - Bracket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">

    <header class="border-b border-gray-800 bg-gray-900/80 backdrop-blur sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <a href="{{ route('public.tournaments.index') }}"
                   class="text-sm text-indigo-400 hover:underline">
                    ← Kembali ke daftar turnamen
                </a>

                <h1 class="mt-2 text-2xl md:text-3xl font-bold text-white">
                    {{ $tournament->name }}
                </h1>

                <p class="mt-1 text-sm text-gray-400">
                    {{ $tournament->game_name }} · {{ str_replace('_', ' ', $tournament->status) }}
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

        <section class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Status</div>
                <div class="mt-1 text-lg font-bold text-white">
                    {{ str_replace('_', ' ', $tournament->status) }}
                </div>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Peserta Approved</div>
                <div class="mt-1 text-lg font-bold text-white">
                    {{ $tournament->approvedParticipants->count() }}/{{ $tournament->max_participants }}
                </div>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Total Match</div>
                <div class="mt-1 text-lg font-bold text-white">
                    {{ $tournament->matches->count() }}
                </div>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Format</div>
                <div class="mt-1 text-lg font-bold text-white">
                    Single Elimination
                </div>
            </div>
        </section>

        @if ($finalMatch && $finalMatch->winner)
            <section class="mb-8 bg-yellow-400 text-yellow-950 rounded-2xl p-6 shadow-sm">
                <div class="text-sm font-semibold">
                    🏆 Juara Turnamen
                </div>
                <div class="mt-1 text-3xl font-black">
                    {{ $finalMatch->winner->team->name }}
                </div>
            </section>
        @endif

        <section class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-white">
                        Bracket Turnamen
                    </h2>
                    <p class="text-sm text-gray-400 mt-1">
                        Data bracket mengikuti update skor terbaru dari admin.
                    </p>
                </div>

                <div class="text-sm text-gray-400">
                    Last update:
                    {{ $tournament->updated_at->format('d M Y H:i') }}
                </div>
            </div>

            @if ($tournament->matches->count() === 0)
                <div class="bg-gray-800 rounded-2xl p-10 text-center">
                    <div class="text-5xl mb-4">🎮</div>
                    <h3 class="text-xl font-bold text-white">
                        Bracket belum dibuat
                    </h3>
                    <p class="mt-2 text-gray-400">
                        Admin belum generate bracket. Jadi belum ada siapa lawan siapa.
                        Sabar, jangan ngamuk ke tombol refresh.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto pb-4">
                    <div class="min-w-[900px] grid grid-cols-3 gap-6">
                        @foreach ($matchesByRound as $round => $matches)
                            <div>
                                <div class="mb-4 flex items-center justify-between">
                                    <h3 class="font-bold text-white">
                                        @if ($loop->last)
                                            Final
                                        @elseif ($loop->remaining === 1)
                                            Semifinal
                                        @else
                                            Round {{ $round }}
                                        @endif
                                    </h3>

                                    <span class="text-xs text-gray-400">
                                        {{ $matches->count() }} match
                                    </span>
                                </div>

                                <div class="space-y-5">
                                    @foreach ($matches as $match)
                                        <div class="bg-gray-950 border border-gray-800 rounded-2xl p-4">
                                            <div class="flex items-center justify-between mb-3">
                                                <span class="text-xs text-gray-500">
                                                    Match {{ $match->match_number }}
                                                </span>

                                                <span class="text-xs px-2 py-1 rounded-full
                                                    @if ($match->status === 'completed') bg-green-900 text-green-300
                                                    @elseif ($match->status === 'scheduled') bg-blue-900 text-blue-300
                                                    @else bg-gray-800 text-gray-400
                                                    @endif">
                                                    {{ ucfirst($match->status) }}
                                                </span>
                                            </div>

                                            <div class="space-y-2">
                                                <div class="flex items-center justify-between rounded-xl px-3 py-3 border
                                                    @if ($match->winner_id && $match->winner_id === $match->team_one_id)
                                                        bg-green-950 border-green-700
                                                    @else
                                                        bg-gray-900 border-gray-800
                                                    @endif">
                                                    <div>
                                                        <div class="font-semibold text-white">
                                                            {{ $match->teamOne?->team?->name ?? 'TBD' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            Team One
                                                        </div>
                                                    </div>

                                                    <div class="text-2xl font-black text-white">
                                                        {{ $match->team_one_score ?? '-' }}
                                                    </div>
                                                </div>

                                                <div class="flex items-center justify-between rounded-xl px-3 py-3 border
                                                    @if ($match->winner_id && $match->winner_id === $match->team_two_id)
                                                        bg-green-950 border-green-700
                                                    @else
                                                        bg-gray-900 border-gray-800
                                                    @endif">
                                                    <div>
                                                        <div class="font-semibold text-white">
                                                            {{ $match->teamTwo?->team?->name ?? 'TBD' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            Team Two
                                                        </div>
                                                    </div>

                                                    <div class="text-2xl font-black text-white">
                                                        {{ $match->team_two_score ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($match->winner)
                                                <div class="mt-3 text-sm text-green-400">
                                                    Winner:
                                                    <strong>{{ $match->winner->team->name }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <section class="mt-8 bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <h2 class="text-xl font-bold text-white mb-4">
                Peserta Approved
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse ($tournament->approvedParticipants as $participant)
                    <div class="bg-gray-950 border border-gray-800 rounded-xl p-4">
                        <div class="font-bold text-white">
                            {{ $participant->team->name }}
                        </div>

                        <div class="mt-1 text-xs text-gray-500">
                            Seed #{{ $participant->seed_number ?? '-' }}
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-gray-400">
                        Belum ada peserta approved.
                    </div>
                @endforelse
            </div>
        </section>

    </main>

</body>
</html>