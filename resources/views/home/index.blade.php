@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">

        {{-- ================= HERO SLIDER (CLEAN IMAGE ONLY) ================= --}}
        <div class="swiper heroSwiper mb-12 group relative">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="relative aspect-[16/9] md:aspect-[21/9] bg-gray-200">
                        <img src="{{ asset('assets/images/slider/slider1.jpg') }}"
                            class="w-full h-full object-cover" alt="Slider 1">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="relative aspect-[16/9] md:aspect-[21/9] bg-gray-200">
                        <img src="{{ asset('assets/images/slider/slider2.jpg') }}"
                            class="w-full h-full object-cover" alt="Slider 2">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="relative aspect-[16/9] md:aspect-[21/9] bg-gray-200">
                        <img src="{{ asset('assets/images/slider/slider3.jpg') }}"
                            class="w-full h-full object-cover" alt="Slider 3">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="relative aspect-[16/9] md:aspect-[21/9] bg-gray-200">
                        <img src="{{ asset('assets/images/slider/slider4.jpg') }}"
                            class="w-full h-full object-cover" alt="Slider 4">
                    </div>
                </div>                
            </div>

            {{-- Navigation Buttons --}}
            <div class="swiper-button-next !text-black !w-12 !h-12 bg-white/80 opacity-0 group-hover:opacity-100 transition after:!text-lg">
            </div>
            <div class="swiper-button-prev !text-black !w-12 !h-12 bg-white/80 opacity-0 group-hover:opacity-100 transition after:!text-lg">
            </div>

            <div class="swiper-pagination !-bottom-2"></div>
        </div>


        {{-- ================= TITLE & FILTER ================= --}}
        <div class="border-b border-gray-200 pb-6 mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex text-xs text-gray-400 uppercase tracking-widest mb-2" aria-label="Breadcrumb">
                    <a href="/" class="hover:text-black">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-black font-bold">Semua Produk</span>
                </nav>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-gray-900">
                    Koleksi Produk <span class="text-red-600">.</span>
                </h1>
            </div>

            <form method="GET" class="w-full md:w-64">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">Filter
                    Kategori</label>
                <div class="relative">
                    <select name="category" onchange="this.form.submit()"
                        class="w-full border-gray-300 rounded-none text-sm font-medium py-2.5 pl-4 pr-10 appearance-none focus:border-black focus:ring-0 transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}"
                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ strtoupper($category->name) }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" />
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        {{-- ================= PRODUCT GRID ================= --}}
        @if ($products->count())
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-4 md:gap-x-6">
                @foreach ($products as $product)
                    <div class="group relative">
                        <a href="{{ route('product.show', $product->slug) }}" class="block">
                            <div class="aspect-[3/4] bg-gray-100 overflow-hidden mb-4 relative">
                                <img src="{{ asset('storage/' . ($product->images->first()->image ?? '')) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-700 ease-in-out">

                                @if ($loop->first)
                                    <div
                                        class="absolute top-0 left-0 bg-red-600 text-white text-[10px] font-bold px-3 py-1.5 uppercase tracking-tighter">
                                        New Arrival
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-1 px-1">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em]">
                                    {{ $product->category->name }}
                                </p>
                                <h3
                                    class="text-sm font-bold text-gray-900 line-clamp-2 leading-snug group-hover:underline decoration-1 underline-offset-4">
                                    {{ $product->name }}
                                </h3>
                                <div class="pt-2">
                                    <p class="text-lg font-black text-gray-900 italic">
                                        Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-20 border-t border-gray-100 pt-10 flex justify-center">
                {{ $products->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-32">
                <p class="text-gray-400 font-bold uppercase tracking-widest text-sm italic">Produk belum tersedia .</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

    <style>
        /* Custom Pagination Style Uniqlo */
        .swiper-pagination-bullet {
            width: 12px;
            height: 2px;
            border-radius: 0;
            background: #ccc;
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background: #000;
            width: 30px;
        }

        /* Clean Pagination Laravel */
        .pagination svg {
            width: 20px;
            display: inline;
        }

        .pagination nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
    </style>
@endsection
