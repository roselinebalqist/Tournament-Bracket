<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Detail Tim / Player
            </h2>

            <a href="{{ route('user.teams.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white/95 backdrop-blur shadow-xl shadow-indigo-950/20 rounded-2xl p-6 border border-white/20">
                <div class="flex items-center gap-4">
                    @if ($team->logo)
                        <img src="{{ $team->logo }}"
                             alt="{{ $team->name }}"
                             class="w-16 h-16 rounded-full object-cover border">
                    @else
                        <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                            {{ strtoupper(substr($team->name, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ $team->name }}
                        </h1>
                        <p class="text-gray-600">
                            {{ ucfirst($team->participant_type) }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <strong>Email Kontak:</strong>
                        <div>{{ $team->contact_email ?? '-' }}</div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg">
                        <strong>No HP / WA:</strong>
                        <div>{{ $team->contact_phone ?? '-' }}</div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg">
                        <strong>Institusi:</strong>
                        <div>{{ $team->institution ?? '-' }}</div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg">
                        <strong>Dibuat:</strong>
                        <div>{{ $team->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">
                        Riwayat Pendaftaran Turnamen
                    </h3>

                    <div class="bg-gray-50 rounded-lg overflow-hidden">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-4 py-3">Turnamen</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($team->tournamentParticipations as $participation)
                                    <tr class="border-b hover:bg-indigo-50 transition">
                                        <td class="px-4 py-3">
                                            {{ $participation->tournament->name }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ ucfirst($participation->status) }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $participation->created_at->format('d M Y H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                            Belum pernah daftar turnamen.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('user.teams.edit', $team) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Edit
                    </a>

                    <a href="{{ route('user.teams.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>