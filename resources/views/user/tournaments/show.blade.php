<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white">
                    Detail Turnamen
                </h2>
                <p class="mt-1 text-gray-400">
                    Lihat detail turnamen, daftar peserta, dan pantau bracket publik.
                </p>
            </div>

            <a href="{{ route('user.tournaments.index') }}"
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

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-900/60 text-red-200 border border-red-700 rounded-2xl">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <section class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black text-white">
                        {{ $tournament->name }}
                    </h1>

                    <p class="mt-2 text-gray-400">
                        {{ $tournament->description ?? 'Belum ada deskripsi.' }}
                    </p>
                </div>

                <span class="px-4 py-2 rounded-full bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 text-sm font-bold">
                    {{ str_replace('_', ' ', $tournament->status) }}
                </span>
            </div>

            <a href="{{ route('public.tournaments.bracket', $tournament) }}"
               target="_blank"
               class="inline-block mt-6 px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/25 transition">
                Lihat Bracket Publik
            </a>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                    <div class="text-sm text-gray-400">Game</div>
                    <div class="mt-1 text-lg font-bold text-white">
                        {{ $tournament->game_name }}
                    </div>
                </div>

                <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                    <div class="text-sm text-gray-400">Status</div>
                    <div class="mt-1 text-lg font-bold text-white">
                        {{ str_replace('_', ' ', $tournament->status) }}
                    </div>
                </div>

                <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                    <div class="text-sm text-gray-400">Peserta Approved</div>
                    <div class="mt-1 text-lg font-bold text-white">
                        {{ $tournament->approvedParticipants->count() }}/{{ $tournament->max_participants }}
                    </div>
                </div>

                <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                    <div class="text-sm text-gray-400">Tipe</div>
                    <div class="mt-1 text-lg font-bold text-white">
                        {{ str_replace('_', ' ', $tournament->type) }}
                    </div>
                </div>

                <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                    <div class="text-sm text-gray-400">Mulai Pendaftaran</div>
                    <div class="mt-1 text-lg font-bold text-white">
                        {{ $tournament->registration_start_at?->format('d M Y H:i') ?? '-' }}
                    </div>
                </div>

                <div class="bg-gray-950 border border-gray-800 rounded-2xl p-5">
                    <div class="text-sm text-gray-400">Akhir Pendaftaran</div>
                    <div class="mt-1 text-lg font-bold text-white">
                        {{ $tournament->registration_end_at?->format('d M Y H:i') ?? '-' }}
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl h-fit">
            <h3 class="text-2xl font-black text-white">
                Daftar ke Turnamen
            </h3>

            <p class="mt-2 text-sm text-gray-400">
                Pilih tim/player yang mau ikut turnamen ini.
            </p>

            @if ($userRegistrations->count())
                <div class="mt-5 space-y-3">
                    <p class="text-sm font-semibold text-gray-300">
                        Tim/player lo yang sudah daftar:
                    </p>

                    @foreach ($userRegistrations as $registration)
                        <div class="p-4 bg-gray-950 border border-gray-800 rounded-2xl">
                            <div class="font-bold text-white">
                                {{ $registration->team->name }}
                            </div>

                            <div class="mt-1 text-sm text-gray-400">
                                Status:
                                <span class="font-bold
                                    @if ($registration->status === 'approved') text-green-400
                                    @elseif ($registration->status === 'rejected') text-red-400
                                    @else text-yellow-400
                                    @endif">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </div>

                            @if ($registration->status === 'pending')
                                <form action="{{ route('user.registrations.destroy', $registration) }}"
                                      method="POST"
                                      class="mt-3"
                                      onsubmit="return confirm('Batalkan pendaftaran ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-sm text-red-400 hover:text-red-300 font-semibold">
                                        Batalkan Pendaftaran
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($tournament->status === 'registration_open')
                <form action="{{ route('user.tournaments.register', $tournament) }}"
                      method="POST"
                      class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Pilih Tim/Player
                        </label>

                        <select name="team_id"
                                class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih tim/player</option>

                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" @selected(old('team_id') == $team->id)>
                                    {{ $team->name }} - {{ ucfirst($team->participant_type) }}
                                </option>
                            @endforeach
                        </select>

                        @error('team_id')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($teams->count())
                        <button type="submit"
                                class="w-full px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/25 transition font-bold">
                            Daftar Sekarang
                        </button>
                    @else
                        <a href="{{ route('user.teams.create') }}"
                           class="block text-center w-full px-4 py-3 bg-yellow-500 text-yellow-950 rounded-xl hover:bg-yellow-400 transition font-bold">
                            Buat Tim/Player Dulu
                        </a>
                    @endif
                </form>
            @else
                <div class="mt-6 p-4 bg-gray-950 border border-gray-800 rounded-2xl text-sm text-gray-400">
                    Pendaftaran turnamen ini sedang tidak dibuka.
                </div>
            @endif
        </section>
    </div>

    <section class="mt-8 bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-black text-white">
                    Peserta Approved
                </h2>
                <p class="mt-1 text-sm text-gray-400">
                    Tim/player yang sudah disetujui admin.
                </p>
            </div>

            <span class="text-sm text-gray-400">
                {{ $tournament->approvedParticipants->count() }} peserta
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse ($tournament->approvedParticipants as $participant)
                <div class="bg-gray-950 border border-gray-800 rounded-2xl p-4">
                    <div class="font-bold text-white">
                        {{ $participant->team->name }}
                    </div>

                    <div class="mt-1 text-xs text-gray-500">
                        Seed #{{ $participant->seed_number ?? '-' }}
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-gray-950 border border-gray-800 rounded-2xl p-6 text-center text-gray-400">
                    Belum ada peserta approved.
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>