<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white">
                    Kelola Turnamen
                </h2>
                <p class="mt-1 text-gray-400">
                    Buat, edit, hapus, dan pantau status turnamen.
                </p>
            </div>

            <a href="{{ route('admin.tournaments.create') }}"
               class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/25 transition">
                + Tambah Turnamen
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

    <section class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white uppercase">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Game</th>
                        <th class="px-6 py-4">Peserta</th>
                        <th class="px-6 py-4">Match</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @forelse ($tournaments as $tournament)
                        <tr class="bg-gray-950 hover:bg-gray-900 transition">
                            <td class="px-6 py-5">
                                <div class="font-bold text-white">
                                    {{ $tournament->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $tournament->slug }}
                                </div>
                            </td>

                            <td class="px-6 py-5 text-gray-300">
                                {{ $tournament->game_name }}
                            </td>

                            <td class="px-6 py-5 text-gray-300">
                                {{ $tournament->participants_count }}/{{ $tournament->max_participants }}
                            </td>

                            <td class="px-6 py-5 text-gray-300">
                                {{ $tournament->matches_count }}
                            </td>

                            <td class="px-6 py-5">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if ($tournament->status === 'completed')
                                        bg-green-900 text-green-300
                                    @elseif ($tournament->status === 'ongoing')
                                        bg-blue-900 text-blue-300
                                    @elseif ($tournament->status === 'registration_open')
                                        bg-indigo-900 text-indigo-300
                                    @elseif ($tournament->status === 'cancelled')
                                        bg-red-900 text-red-300
                                    @else
                                        bg-gray-800 text-gray-300
                                    @endif">
                                    {{ str_replace('_', ' ', $tournament->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.tournaments.show', $tournament) }}"
                                       class="text-blue-400 hover:text-blue-300 font-semibold">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.tournaments.edit', $tournament) }}"
                                       class="text-yellow-400 hover:text-yellow-300 font-semibold">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.tournaments.destroy', $tournament) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Yakin hapus turnamen ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-400 hover:text-red-300 font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-gray-950">
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                Belum ada turnamen. Klik "Tambah Turnamen" dulu, jangan nunggu bracket muncul dari langit.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="mt-6 text-gray-200">
        {{ $tournaments->links() }}
    </div>
</x-app-layout>