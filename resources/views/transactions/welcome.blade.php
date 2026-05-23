@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-400 via-red-600 to-red-700 text-white">
    
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-6 pt-20 pb-16">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            
            <!-- Left Content -->
            <div class="lg:w-1/2 space-y-8">
                <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-md px-5 py-2 rounded-full text-sm font-medium">
                    <span class="w-3 h-3 bg-yellow-300 rounded-full animate-pulse"></span>
                    OFFICIAL STORE
                </div>

                <h1 class="text-6xl lg:text-7xl font-bold leading-tight">
                    TOKO <span class="text-yellow-300">AMIEN</span>
                </h1>

                <p class="text-2xl text-white/90">
                    Seragam Sekolah, PNS, TNI, POLRI & Lainnya
                </p>

                <div class="flex flex-wrap gap-4 text-lg">
                    <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                        ✅ Berkualitas
                    </div>
                    <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                        ✅ Harga Terjangkau
                    </div>
                    <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                        ✅ Ready Stock
                    </div>
                </div>

                <div class="flex gap-4 pt-6">
                    <a href="{{ route('login') }}" 
                       class="bg-white text-red-700 hover:bg-yellow-300 hover:text-red-700 font-semibold px-8 py-4 rounded-2xl text-lg transition-all">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="border-2 border-white hover:bg-white hover:text-red-700 font-semibold px-8 py-4 rounded-2xl text-lg transition-all">
                        Daftar
                    </a>
                </div>

                <div class="pt-8 text-sm opacity-75">
                    📍 JL. PADANG PADI 14 KALIOMBO KEDIRI<br>
                    📞 081 259 708 001
                </div>
            </div>

            <!-- Right Side - Logo Display -->
            <div class="lg:w-1/2 flex justify-center">
                <div class="relative">
                    <div class="bg-white p-8 rounded-3xl shadow-2xl">
                        <img src="/images/logo-amien.jpeg" alt="Toko Amien" class="max-w-md w-full">
                        <!-- If you don't have image yet, use this SVG version -->
                    </div>
                    
                    <!-- Decorative Elements -->
                    <div class="absolute -top-6 -right-6 bg-yellow-300 text-red-700 text-5xl font-bold px-6 py-3 rounded-2xl rotate-12 shadow-xl">
                        AMIEN
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="bg-white text-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-center text-4xl font-bold mb-12">Mengapa Memilih Toko Amien?</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-6xl mb-4">👕</div>
                    <h3 class="text-2xl font-semibold mb-2">Seragam Berkualitas</h3>
                    <p class="text-gray-600">Bahan nyaman, jahitan rapi, dan tahan lama</p>
                </div>
                <div class="text-center">
                    <div class="text-6xl mb-4">🏢</div>
                    <h3 class="text-2xl font-semibold mb-2">PNS & TNI</h3>
                    <p class="text-gray-600">Seragam dinas lengkap sesuai standar</p>
                </div>
                <div class="text-center">
                    <div class="text-6xl mb-4">🚚</div>
                    <h3 class="text-2xl font-semibold mb-2">Pelayanan Cepat</h3>
                    <p class="text-gray-600">Siap antar dan melayani custom order</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection