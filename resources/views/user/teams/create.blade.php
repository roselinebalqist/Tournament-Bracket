<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white">
                    Tambah Tim / Player
                </h2>
                <p class="mt-1 text-gray-400">
                    Buat tim atau player yang nanti bisa didaftarkan ke turnamen.
                </p>
            </div>

            <a href="{{ route('user.teams.index') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-xl hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <section class="max-w-4xl mx-auto">
        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8 shadow-xl">

            <div class="mb-8">
                <h1 class="text-2xl font-black text-white">
                    Data Tim / Player
                </h1>
                <p class="mt-2 text-sm text-gray-400">
                    Isi data dengan benar. Jangan bikin nama tim “aaa” terus berharap keliatan serius.
                </p>
            </div>

            <form action="{{ route('user.teams.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block font-semibold text-sm text-gray-200 mb-2">
                        Tipe Peserta
                    </label>

                    <select name="participant_type"
                            class="w-full rounded-2xl border border-gray-700 bg-gray-950 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" class="bg-gray-950 text-white">Pilih tipe</option>
                        <option value="team" class="bg-gray-950 text-white" @selected(old('participant_type') === 'team')>
                            Team
                        </option>
                        <option value="player" class="bg-gray-950 text-white" @selected(old('participant_type') === 'player')>
                            Player
                        </option>
                    </select>

                    @error('participant_type')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold text-sm text-gray-200 mb-2">
                        Nama Tim / Player
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Shadow Wolves"
                           class="w-full rounded-2xl border border-gray-700 bg-gray-950 text-white placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    @error('name')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Email Kontak
                        </label>

                        <input type="email"
                               name="contact_email"
                               value="{{ old('contact_email') }}"
                               placeholder="team@email.com"
                               class="w-full rounded-2xl border border-gray-700 bg-gray-950 text-white placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('contact_email')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-sm text-gray-200 mb-2">
                            Nomor HP / WhatsApp
                        </label>

                        <input type="text"
                               name="contact_phone"
                               value="{{ old('contact_phone') }}"
                               placeholder="08xxxxxxxxxx"
                               class="w-full rounded-2xl border border-gray-700 bg-gray-950 text-white placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('contact_phone')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-sm text-gray-200 mb-2">
                        Institusi / Kampus
                    </label>

                    <input type="text"
                           name="institution"
                           value="{{ old('institution') }}"
                           placeholder="Contoh: Universitas Syiah Kuala"
                           class="w-full rounded-2xl border border-gray-700 bg-gray-950 text-white placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    @error('institution')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold text-sm text-gray-200 mb-2">
                        Logo URL
                    </label>

                    <input type="text"
                           name="logo"
                           value="{{ old('logo') }}"
                           placeholder="Opsional, isi URL gambar kalau ada"
                           class="w-full rounded-2xl border border-gray-700 bg-gray-950 text-white placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    @error('logo')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                    <a href="{{ route('user.teams.index') }}"
                       class="px-5 py-3 bg-gray-800 text-gray-300 rounded-2xl hover:bg-gray-700 hover:text-white transition text-center font-bold">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl hover:from-indigo-500 hover:to-purple-500 shadow-lg shadow-indigo-500/25 transition font-bold">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>