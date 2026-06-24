<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Tim / Player
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/95 backdrop-blur shadow-xl shadow-indigo-950/20 rounded-2xl p-6 border border-white/20">

                <form action="{{ route('user.teams.update', $team) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Tipe Peserta</label>
                        <select name="participant_type"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            <option value="team" @selected(old('participant_type', $team->participant_type) === 'team')>Team</option>
                            <option value="player" @selected(old('participant_type', $team->participant_type) === 'player')>Player</option>
                        </select>
                        @error('participant_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nama Tim / Player</label>
                        <input type="text" name="name" value="{{ old('name', $team->name) }}"
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Email Kontak</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $team->contact_email) }}"
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        @error('contact_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nomor HP / WhatsApp</label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $team->contact_phone) }}"
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        @error('contact_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Institusi / Kampus</label>
                        <input type="text" name="institution" value="{{ old('institution', $team->institution) }}"
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        @error('institution')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Logo URL</label>
                        <input type="text" name="logo" value="{{ old('logo', $team->logo) }}"
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('user.teams.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/25 transition">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>