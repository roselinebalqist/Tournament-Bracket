<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white">
                    Detail Turnamen
                </h2>
                <p class="mt-1 text-gray-400">
                    Kelola data turnamen, peserta, bracket, dan skor.
                </p>
            </div>

            <a href="{{ route('admin.tournaments.index') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-xl hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-900/60 text-green-200 border border-green-700 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-900/60 text-red-200 border border-red-700 rounded-2xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-white">
                    {{ $tournament->name }}
                </h1>

                <p class="mt-2 text-gray-400 max-w-3xl">
                    {{ $tournament->description ?? 'Belum ada deskripsi.' }}
                </p>
            </div>

            <span class="px-4 py-2 rounded-full bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 text-sm font-bold">
                {{ str_replace('_', ' ', $tournament->status) }}
            </span>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Game</div>
                <div class="mt-1 text-lg font-bold text-white">
                    {{ $tournament->game_name }}
                </div>
            </div>

            <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Peserta Approved</div>
                <div class="mt-1 text-lg font-bold text-white">
                    {{ $tournament->approvedParticipants->count() }}/{{ $tournament->max_participants }}
                </div>
            </div>

            <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Total Match</div>
                <div class="mt-1 text-lg font-bold text-white">
                    {{ $tournament->matches->count() }}
                </div>
            </div>

            <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                <div class="text-sm text-gray-400">Format</div>
                <div class="mt-1 text-lg font-bold text-white">
                    Single Elimination
                </div>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('admin.tournaments.participants.index', $tournament) }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">
                Kelola Peserta
            </a>

            @if ($tournament->matches->count() === 0)
                <form action="{{ route('admin.tournaments.generate-bracket', $tournament) }}"
                      method="POST"
                      onsubmit="return confirm('Generate bracket sekarang? Pastikan peserta approved sudah sesuai slot.')">
                    @csrf

                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">
                        Generate Bracket
                    </button>
                </form>
            @else
                <span class="px-4 py-2 bg-gray-800 text-gray-300 rounded-xl border border-gray-700">
                    Bracket sudah dibuat
                </span>
            @endif

            <a href="{{ route('public.tournaments.bracket', $tournament) }}"
               target="_blank"
               class="px-4 py-2 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">
                Lihat Bracket Publik
            </a>

            <a href="{{ route('admin.tournaments.edit', $tournament) }}"
               class="px-4 py-2 bg-yellow-500 text-yellow-950 rounded-xl hover:bg-yellow-400 transition font-bold">
                Edit Turnamen
            </a>
        </div>
    </section>

    <section class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-white">
                    Bracket Turnamen
                </h2>
                <p class="text-sm text-gray-400 mt-1">
                    Input skor dan pantau winner naik otomatis ke round berikutnya.
                </p>
            </div>

            <div class="text-sm text-gray-400">
                {{ $tournament->matches->count() }} Match
            </div>
        </div>

        @php
            $finalMatch = $tournament->matches
                ->sortByDesc('round')
                ->first();
        @endphp

        @if ($finalMatch && $finalMatch->winner)
            <div class="mb-8 bg-yellow-400 text-yellow-950 rounded-2xl p-6 shadow-sm">
                <div class="text-sm font-semibold">
                    🏆 Juara Turnamen
                </div>
                <div class="mt-1 text-3xl font-black">
                    {{ $finalMatch->winner->team->name }}
                </div>
            </div>
        @endif

        @if ($tournament->matches->count() === 0)
            <div class="bg-gray-800 rounded-2xl p-10 text-center">
                <div class="text-5xl mb-4">🎮</div>
                <h3 class="text-xl font-bold text-white">
                    Bracket belum dibuat
                </h3>
                <p class="mt-2 text-gray-400">
                    Approve peserta dulu, baru generate bracket.
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

                                        @if ($match->team_one_id && $match->team_two_id)
                                            <div class="mt-4">
                                                <a href="{{ route('admin.matches.score.edit', $match) }}"
                                                   class="inline-block px-3 py-2 bg-indigo-600 text-white text-xs rounded-xl hover:bg-indigo-700 transition">
                                                    Input Skor
                                                </a>
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
</x-app-layout>