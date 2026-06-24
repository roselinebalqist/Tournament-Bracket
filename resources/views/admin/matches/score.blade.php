<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    Input Skor Match
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    {{ $match->tournament->name }}
                </p>
            </div>

            <a href="{{ route('admin.tournaments.show', $match->tournament) }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white/95 backdrop-blur shadow-xl shadow-indigo-950/20 rounded-2xl p-6 border border-white/20">
                <div class="mb-6">
                    <div class="text-sm text-gray-500">
                        Round {{ $match->round }} · Match {{ $match->match_number }}
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $match->teamOne?->team?->name ?? 'TBD' }}
                        <span class="text-gray-400">vs</span>
                        {{ $match->teamTwo?->team?->name ?? 'TBD' }}
                    </h1>

                    <p class="text-sm text-gray-600 mt-2">
                        Status: {{ ucfirst($match->status) }}
                    </p>
                </div>

                @if (! $match->team_one_id || ! $match->team_two_id)
                    <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                        Match ini belum lengkap. Tunggu pemenang dari match sebelumnya dulu.
                    </div>
                @else
                    <form action="{{ route('admin.matches.score.update', $match) }}"
                          method="POST"
                          class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 border rounded-lg">
                                <label class="block font-medium text-sm text-gray-700">
                                    {{ $match->teamOne->team->name }}
                                </label>

                                <input type="number"
                                       name="team_one_score"
                                       min="0"
                                       value="{{ old('team_one_score', $match->team_one_score) }}"
                                       class="mt-2 w-full rounded-md border-gray-300 shadow-sm">

                                @error('team_one_score')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="p-4 border rounded-lg">
                                <label class="block font-medium text-sm text-gray-700">
                                    {{ $match->teamTwo->team->name }}
                                </label>

                                <input type="number"
                                       name="team_two_score"
                                       min="0"
                                       value="{{ old('team_two_score', $match->team_two_score) }}"
                                       class="mt-2 w-full rounded-md border-gray-300 shadow-sm">

                                @error('team_two_score')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @if ($match->winner)
                            <div class="p-4 bg-green-100 text-green-700 rounded-lg">
                                Winner saat ini:
                                <strong>{{ $match->winner->team->name }}</strong>
                            </div>
                        @endif

                        @if ($match->nextMatch)
                            <div class="p-4 bg-blue-50 text-blue-700 rounded-lg text-sm">
                                Winner match ini akan masuk ke
                                <strong>
                                    Round {{ $match->nextMatch->round }},
                                    Match {{ $match->nextMatch->match_number }}
                                </strong>
                                sebagai
                                <strong>{{ str_replace('_', ' ', $match->next_match_slot) }}</strong>.
                            </div>
                        @else
                            <div class="p-4 bg-purple-50 text-purple-700 rounded-lg text-sm">
                                Ini adalah final. Winner dari match ini akan menjadi juara turnamen.
                            </div>
                        @endif

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.tournaments.show', $match->tournament) }}"
                               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/25 transition">
                                Simpan Skor
                            </button>
                        </div>
                    </form>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>