<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white">
                    Approval Peserta
                </h2>
                <p class="mt-1 text-gray-400">
                    {{ $tournament->name }} — setujui atau tolak peserta yang mendaftar.
                </p>
            </div>

            <a href="{{ route('admin.tournaments.show', $tournament) }}"
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

    <section class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-xl">
            <div class="text-sm text-gray-400">
                Peserta Approved
            </div>

            <div class="mt-2 text-4xl font-black text-white">
                {{ $approvedCount }}/{{ $tournament->max_participants }}
            </div>

            <p class="mt-2 text-sm text-gray-500">
                Jumlah peserta yang sudah disetujui admin.
            </p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-xl">
            <div class="text-sm text-gray-400">
                Status Turnamen
            </div>

            <div class="mt-2">
                <span class="px-3 py-1 rounded-full text-sm font-bold
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

            <p class="mt-4 text-sm text-gray-500">
                Approval bisa dilakukan sebelum turnamen berjalan.
            </p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-xl">
            <div class="text-sm text-gray-400">
                Maksimal Peserta
            </div>

            <div class="mt-2 text-4xl font-black text-white">
                {{ $tournament->max_participants }}
            </div>

            <p class="mt-2 text-sm text-gray-500">
                Slot penuh jika approved sudah mencapai batas ini.
            </p>
        </div>
    </section>

    <section class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white uppercase">
                    <tr>
                        <th class="px-6 py-4">Tim / Player</th>
                        <th class="px-6 py-4">Pendaftar</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @forelse ($participants as $participant)
                        <tr class="bg-gray-950 hover:bg-gray-900 transition">
                            <td class="px-6 py-5">
                                <div class="font-bold text-white">
                                    {{ $participant->team->name }}
                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    {{ ucfirst($participant->team->participant_type) }}
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <div class="font-semibold text-gray-200">
                                    {{ $participant->registeredBy->name }}
                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    Akun yang mendaftarkan tim ini
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <div class="text-gray-300">
                                    {{ $participant->team->contact_email ?? '-' }}
                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    {{ $participant->team->contact_phone ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if ($participant->status === 'approved')
                                        bg-green-500/10 text-green-300 border border-green-500/20
                                    @elseif ($participant->status === 'rejected')
                                        bg-red-500/10 text-red-300 border border-red-500/20
                                    @else
                                        bg-yellow-500/10 text-yellow-300 border border-yellow-500/20
                                    @endif">
                                    {{ ucfirst($participant->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-3">
                                    <form action="{{ route('admin.participants.approve', $participant) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                                class="px-3 py-2 rounded-xl bg-green-500/10 text-green-300 border border-green-500/20 hover:bg-green-500 hover:text-white transition font-bold">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.participants.reject', $participant) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                                class="px-3 py-2 rounded-xl bg-red-500/10 text-red-300 border border-red-500/20 hover:bg-red-500 hover:text-white transition font-bold">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-gray-950">
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                Belum ada peserta yang daftar. 
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="mt-6 text-gray-200">
        {{ $participants->links() }}
    </div>
</x-app-layout>