<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white">
                    Tim / Player Saya
                </h2>
                <p class="mt-1 text-gray-400">
                    Kelola tim atau player yang akan didaftarkan ke turnamen.
                </p>
            </div>

            <a href="{{ route('user.teams.create') }}"
               class="px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl hover:from-indigo-500 hover:to-purple-500 shadow-lg shadow-indigo-500/25 transition font-bold">
                + Tambah Tim/Player
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

    <section class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white uppercase">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4">Email Kontak</th>
                        <th class="px-6 py-4">Institusi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @forelse ($teams as $team)
                        <tr class="bg-gray-950 hover:bg-gray-900 transition">
                            <td class="px-6 py-5">
                                <div class="font-bold text-white">
                                    {{ $team->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    Dibuat {{ $team->created_at->format('d M Y') }}
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if ($team->participant_type === 'team')
                                        bg-indigo-500/10 text-indigo-300 border border-indigo-500/20
                                    @else
                                        bg-cyan-500/10 text-cyan-300 border border-cyan-500/20
                                    @endif">
                                    {{ ucfirst($team->participant_type) }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-gray-300">
                                {{ $team->contact_email ?? '-' }}
                            </td>

                            <td class="px-6 py-5 text-gray-300">
                                {{ $team->institution ?? '-' }}
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('user.teams.show', $team) }}"
                                       class="text-blue-400 hover:text-blue-300 font-semibold">
                                        Detail
                                    </a>

                                    <a href="{{ route('user.teams.edit', $team) }}"
                                       class="text-yellow-400 hover:text-yellow-300 font-semibold">
                                        Edit
                                    </a>

                                    <form action="{{ route('user.teams.destroy', $team) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Yakin hapus tim/player ini?')">
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
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                Belum ada tim/player. Bikin dulu, masa mau ikut turnamen modal doa doang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="mt-6 text-gray-200">
        {{ $teams->links() }}
    </div>
</x-app-layout>