<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <a href="{{ route('user.tournaments.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50">
    <h3 class="font-bold">Daftar Turnamen</h3>
    <p class="text-sm text-gray-600">Lihat turnamen yang tersedia.</p>
        </a>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
