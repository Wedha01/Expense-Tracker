@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-950 via-red-950 to-black flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        
        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="flex justify-center mb-4">
                <span class="text-6xl">🛍️</span>
            </div>
            <h1 class="text-4xl font-bold text-white tracking-tight">TOKOH AMIEM</h1>
            <p class="text-yellow-400 mt-1 text-lg">Seragam & Perlengkapan</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-white mb-2">Email</label>
                    <input type="email" name="email" 
                           value="{{ old('email') }}"
                           class="w-full px-5 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-yellow-400 focus:ring-yellow-400"
                           required autofocus />
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-white mb-2">Password</label>
                    <input type="password" name="password" 
                           class="w-full px-5 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-yellow-400 focus:ring-yellow-400"
                           required />
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-white/80">
                        <input type="checkbox" name="remember" class="w-4 h-4 bg-white/10 border-white/30 rounded accent-yellow-400">
                        <span class="ml-2 text-sm">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-yellow-400 hover:text-yellow-300 text-sm">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 py-4 rounded-2xl text-white font-semibold text-lg transition-all active:scale-95">
                    LOG IN
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <p class="text-white/60 text-sm">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-yellow-400 hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>
@endsection