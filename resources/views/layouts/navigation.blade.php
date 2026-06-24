<nav class="border-b border-gray-800 bg-gray-900/80 backdrop-blur sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/25">
                        🏆
                    </div>

                    <div>
                        <div class="font-black text-white leading-tight">
                            Tournament Bracket
                        </div>
                        <div class="text-xs text-gray-400">
                            Sistem Manajemen Turnamen
                        </div>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-gray-800 transition">
                        Dashboard
                    </a>

                    @if (auth()->user()?->role === 'admin')
                        <a href="{{ route('admin.tournaments.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-gray-800 transition">
                            Turnamen
                        </a>
                    @endif

                    @if (auth()->user()?->role === 'user')
                        <a href="{{ route('user.tournaments.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-gray-800 transition">
                            Turnamen
                        </a>

                        <a href="{{ route('user.teams.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-gray-800 transition">
                            Tim Saya
                        </a>
                    @endif

                    <a href="{{ route('public.tournaments.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-gray-800 transition">
                        Bracket Publik
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden sm:block text-right">
                    <div class="text-sm font-bold text-white">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-xs text-gray-400 uppercase">
                        {{ Auth::user()->role }}
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-red-500/10 text-red-300 border border-red-500/20 hover:bg-red-500 hover:text-white transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>