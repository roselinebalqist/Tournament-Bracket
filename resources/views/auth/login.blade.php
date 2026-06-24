<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-black text-white">
            Welcome Back
        </h2>
        <p class="mt-2 text-sm text-gray-400">
            Ayuks masuk dulu bes!!
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">
                Email
            </label>
            <input id="email"
                   class="w-full rounded-2xl border border-white/10 bg-white/10 text-white placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-500/30"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="username"
                   placeholder="contoh@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">
                Password
            </label>
            <input id="password"
                   class="w-full rounded-2xl border border-white/10 bg-white/10 text-white placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-500/30"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me"
                   type="checkbox"
                   class="rounded border-white/20 bg-white/10 text-indigo-500 focus:ring-indigo-500"
                   name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-300">
                Remember me
            </label>
        </div>

        <div class="flex items-center justify-between gap-3 pt-2">
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-300 hover:text-indigo-200 hover:underline"
                   href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold tracking-wide hover:from-indigo-400 hover:to-purple-500 shadow-[0_0_30px_rgba(99,102,241,0.35)] hover:shadow-[0_0_45px_rgba(168,85,247,0.45)] transition">
                LOG IN
            </button>
        </div>
    </form>
</x-guest-layout>