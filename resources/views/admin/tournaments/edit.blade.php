<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white">
                    Edit Turnamen
                </h2>
                <p class="mt-1 text-gray-400">
                    Ubah informasi turnamen, status, dan jadwal pelaksanaan.
                </p>
            </div>

            <a href="{{ route('admin.tournaments.index') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-xl hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <section class="dark-form max-w-4xl mx-auto">
        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8 shadow-2xl shadow-indigo-500/10">

            <div class="mb-8">
                <h1 class="text-2xl font-black text-white">
                    Data Turnamen
                </h1>
                <p class="mt-2 text-sm text-gray-400">
                    Perbarui data turnamen dengan benar. Jangan asal edit, nanti bracket ikut tantrum.
                </p>
            </div>

            <form action="{{ route('admin.tournaments.update', $tournament) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold text-sm text-gray-200 mb-2">
                        Nama Turnamen
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $tournament->name) }}"
                           placeholder="Contoh: Campus Esports Cup 2026"
                           class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    @error('name')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold text-sm text-gray-200 mb-2">
                        Nama Game
                    </label>

                    <input type="text"
                           name="game_name"
                           value="{{ old('game_name', $tournament->game_name) }}"
                           placeholder="Contoh: Mobile Legends / Futsal / Badminton"
                           class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    @error('game_name')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold text-sm text-gray-200 mb-2">
                        Deskripsi
                    </label>

                    <textarea name="description"
                              rows="5"
                              placeholder="Deskripsi singkat turnamen"
                              class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $tournament->description) }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Maksimal Peserta
                        </label>

                        <select name="max_participants"
                                class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="4" @selected(old('max_participants', $tournament->max_participants) == 4)>4 Tim</option>
                            <option value="8" @selected(old('max_participants', $tournament->max_participants) == 8)>8 Tim</option>
                            <option value="16" @selected(old('max_participants', $tournament->max_participants) == 16)>16 Tim</option>
                        </select>

                        @error('max_participants')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Status
                        </label>

                        <select name="status"
                                class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="draft" @selected(old('status', $tournament->status) === 'draft')>Draft</option>
                            <option value="registration_open" @selected(old('status', $tournament->status) === 'registration_open')>Registration Open</option>
                            <option value="registration_closed" @selected(old('status', $tournament->status) === 'registration_closed')>Registration Closed</option>
                            <option value="ongoing" @selected(old('status', $tournament->status) === 'ongoing')>Ongoing</option>
                            <option value="completed" @selected(old('status', $tournament->status) === 'completed')>Completed</option>
                            <option value="cancelled" @selected(old('status', $tournament->status) === 'cancelled')>Cancelled</option>
                        </select>

                        @error('status')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Mulai Pendaftaran
                        </label>

                        <input type="datetime-local"
                               name="registration_start_at"
                               value="{{ old('registration_start_at', optional($tournament->registration_start_at)->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('registration_start_at')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Akhir Pendaftaran
                        </label>

                        <input type="datetime-local"
                               name="registration_end_at"
                               value="{{ old('registration_end_at', optional($tournament->registration_end_at)->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('registration_end_at')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Mulai Turnamen
                        </label>

                        <input type="datetime-local"
                               name="started_at"
                               value="{{ old('started_at', optional($tournament->started_at)->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('started_at')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Selesai Turnamen
                        </label>

                        <input type="datetime-local"
                               name="ended_at"
                               value="{{ old('ended_at', optional($tournament->ended_at)->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-2xl border shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('ended_at')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                    <a href="{{ route('admin.tournaments.index') }}"
                       class="px-5 py-3 bg-gray-800 text-gray-300 rounded-2xl hover:bg-gray-700 hover:text-white transition text-center font-bold">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl hover:from-indigo-500 hover:to-purple-500 shadow-lg shadow-indigo-500/25 transition font-bold">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>