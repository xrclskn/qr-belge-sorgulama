<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center mb-8">
            <h2 class="text-2xl font-semibold text-slate-800">Welcome</h2>
            <p class="text-sm text-slate-500 mt-1">Please enter your credentials</p>
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
            <input id="email" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
            <input id="password" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-8">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-[#176b87] shadow-sm focus:ring-[#176b87] cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-slate-600 select-none">Remember me</span>
            </label>
        </div>

        <button class="w-full bg-[#176b87] hover:bg-[#125368] text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg shadow-[#176b87]/30">
            Log in
        </button>
    </form>
</x-guest-layout>
