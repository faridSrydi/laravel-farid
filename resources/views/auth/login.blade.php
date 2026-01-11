@extends('layouts.app')

@section('content')
<div class="min-h-[80-screen] flex items-center justify-center py-20 px-4">
    <div class="max-w-md w-full">
        
        {{-- Logo/Heading --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black uppercase tracking-tighter mb-2">
                MASUK <span class="text-red-600">.</span>
            </h1>
            <p class="text-xs text-gray-500 uppercase tracking-[0.2em] font-medium">
                Gunakan akun Laraclo Anda
            </p>
        </div>

        <div class="bg-white border border-gray-200 p-8 md:p-10 shadow-sm">
            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-600">
                    <p class="text-xs font-bold text-red-600 uppercase tracking-tight">
                        {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email Field --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">
                        Alamat Email *
                    </label>
                    <input type="email" name="email" 
                           class="w-full border-gray-300 rounded-none text-sm py-3 px-4 focus:ring-0 focus:border-black transition"
                           placeholder="nama@email.com" 
                           required autofocus>
                </div>

                {{-- Password Field --}}
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                            Kata Sandi *
                        </label>
                        <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-black uppercase underline">Lupa?</a>
                    </div>
                    <input type="password" name="password" 
                           class="w-full border-gray-300 rounded-none text-sm py-3 px-4 focus:ring-0 focus:border-black transition"
                           placeholder="••••••••" 
                           required>
                </div>

                {{-- Login Button --}}
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-black text-white text-sm font-black uppercase tracking-widest py-4 hover:bg-gray-800 transition duration-300">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            {{-- Footer Form --}}
            <div class="mt-10 pt-8 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium mb-4">Belum memiliki akun Laraclo?</p>
                <a href="{{ route('register') }}" 
                   class="inline-block w-full border border-black text-black text-sm font-black uppercase tracking-widest py-4 hover:bg-black hover:text-white transition duration-300">
                    Buat Akun Baru
                </a>
            </div>
        </div>

        {{-- Help Links --}}
        <div class="mt-8 flex justify-center gap-6">
            <a href="#" class="text-[10px] font-bold text-gray-400 uppercase hover:text-black transition">Bantuan</a>
            <a href="#" class="text-[10px] font-bold text-gray-400 uppercase hover:text-black transition">Ketentuan Penggunaan</a>
        </div>
    </div>
</div>
@endsection
