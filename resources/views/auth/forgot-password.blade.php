@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-950 via-red-950 to-black flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        
        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="flex justify-center mb-4">
                <span class="text-6xl">💰</span>
            </div>
            <h1 class="text-4xl font-bold text-white tracking-tight">TOKOH AMIEM</h1>
            <p class="text-yellow-400 mt-1">Forgot Password</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            
            <div class="mb-6 text-white/80 text-sm">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-white mb-2">Email Address</label>
                    <input type="email" name="email" 
                           value="{{ old('email') }}"
                           class="w-full px-5 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-yellow-400"
                           required autofocus />
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 py-4 rounded-2xl text-white font-semibold text-lg transition-all active:scale-95">
                    SEND PASSWORD RESET LINK
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <p class="text-white/60 text-sm">
                Remember your password? 
                <a href="{{ route('login') }}" class="text-yellow-400 hover:underline">Back to Login</a>
            </p>
        </div>
    </div>
</div>
@endsection