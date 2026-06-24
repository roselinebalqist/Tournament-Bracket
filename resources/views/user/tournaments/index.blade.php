<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-black text-white">
                Daftar Turnamen
            </h2>
            <p class="mt-1 text-gray-400">
                Pilih turnamen, daftar pakai tim/player lo, dan pantau bracket publik.
            </p>
        </div>
    </x-slot>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($tournaments as $tournament)
            <div class="group bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-xl hover:border-indigo-500/50 hover:shadow-indigo-500/10 transition duration-300">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-black text-white group-hover:text-indigo-300 transition">
                            {{ $tournament->name }}
                        </h3>

                        <p class="mt-1 text-gray-400 font-medium">
                            {{ $tournament->game_name }}
                        </p>
                    </div>

                    <span class="shrink-0 text-xs px-3 py-1 rounded-full font-bold
                        @if ($tournament->status === 'completed')
                            bg-green-500/10 text-green-300 border border-green-500/20
                        @elseif ($tournament->status === 'ongoing')
                            bg-blue-500/10 text-blue-300 border border-blue-500/20
                        @elseif ($tournament->status === 'registration_open')
                            bg-indigo-500/10 text-indigo-300 border border-indigo-500/20
                        @elseif ($tournament->status === 'cancelled')
                            bg-red-500/10 text-red-300 border border-red-500/20
                        @else
                            bg-gray-800 text-gray-300 border border-gray-700
                        @endif">
                        {{ str_replace('_', ' ', $tournament->status) }}
                    </span>
                </div>

                <p class="mt-5 text-sm text-gray-400 leading-relaxed min-h-[48px]">
                    {{ $tournament->description ?? 'Belum ada deskripsi.' }}
                </p>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="bg-gray-950 border border-gray-800 rounded-2xl p-4">
                        <div class="text-xs text-gray-500">
                            Peserta
                        </div>
                        <div class="mt-1 text-xl font-black text-white">
                            {{ $tournament->approved_participants_count }}/{{ $tournament->max_participants }}
                        </div>
                    </div>

                    <div class="bg-gray-950 border border-gray-800 rounded-2xl p-4">
                        <div class="text-xs text-gray-500">
                            Match
                        </div>
                        <div class="mt-1 text-xl font-black text-white">
                            {{ $tournament->matches_count }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('user.tournaments.show', $tournament) }}"
                       class="inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl hover:from-indigo-500 hover:to-purple-500 shadow-lg shadow-indigo-500/20 transition font-bold">
                        Lihat Detail
                    </a>

                    <a href="{{ route('public.tournaments.bracket', $tournament) }}"
                       target="_blank"
                       class="inline-flex items-center justify-center px-5 py-3 bg-gray-800 text-gray-200 rounded-2xl hover:bg-gray-700 hover:text-white transition font-bold">
                        Bracket
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-gray-900 border border-gray-800 rounded-3xl p-10 text-center">
                <div class="text-5xl mb-4">🎮</div>
                <h3 class="text-xl font-black text-white">
                    Belum ada turnamen tersedia
                </h3>
                <p class="mt-2 text-gray-400">
                    Admin-nya mungkin lagi AFK, atau lagi debat warna tombol sama dirinya sendiri.
                </p>
            </div>
        @endforelse
    </section>

    <div class="mt-8 text-gray-200">
        {{ $tournaments->links() }}
    </div>
</x-app-layout>