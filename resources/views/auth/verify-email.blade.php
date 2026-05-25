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
            <p class="text-yellow-400 mt-1">Verify Your Email</p>
        </div>

        <!-- Verification Card -->
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            
            <div class="mb-6 text-white/80 text-sm leading-relaxed">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 bg-green-500/20 border border-green-500/30 text-green-400 rounded-2xl p-4 text-sm">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="flex flex-col gap-4">
                <!-- Resend Verification -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 py-4 rounded-2xl text-gray-900 font-semibold text-lg transition-all">
                        RESEND VERIFICATION EMAIL
                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full py-4 border border-white/30 hover:bg-white/10 rounded-2xl text-white font-medium transition-all">
                        LOG OUT
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center mt-6">
            <p class="text-white/60 text-sm">
                Already verified? 
                <a href="{{ route('login') }}" class="text-yellow-400 hover:underline">Go to Login</a>
            </p>
        </div>
    </div>
</div>
@endsection