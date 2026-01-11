<header class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ mobileMenu: false }">
    <div class="bg-gray-100 py-1.5 px-4 text-center">
        <p class="text-[11px] tracking-widest uppercase font-medium text-gray-600">
            Gratis Ongkir Minimal Belanja Rp 699.000
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="flex items-center justify-between h-20">
            
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <span class="text-2xl font-black tracking-tighter bg-red-600 text-white px-2 py-1">
                        LARA<span class="font-light">CLO</span>
                    </span>
                </a>

                <nav class="hidden lg:flex items-center gap-6">
                    <a href="{{ route('home') }}" 
                       class="text-sm font-bold uppercase tracking-wider transition hover:text-red-600 {{ request()->routeIs('home') && !request('category') ? 'text-red-600' : 'text-gray-800' }}">
                        Home
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('home', ['category' => $category->slug]) }}" 
                           class="text-sm font-bold uppercase tracking-wider transition hover:text-red-600 {{ request('category') == $category->slug ? 'text-red-600' : 'text-gray-800' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach

                    @auth
                        <a href="{{ Auth::user()->hasRole('admin') ? route('admin.dashboard') : route('user.dashboard') }}" 
                           class="text-sm font-bold uppercase tracking-wider text-gray-800 hover:text-red-600 transition">
                            My Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-sm font-bold uppercase tracking-wider text-gray-800 hover:text-red-600 transition">
                            Login
                        </a>
                    @endauth

                    <a href="#" class="text-sm font-bold uppercase tracking-wider text-red-600 transition">Sale</a>
                </nav>
            </div>

            <div class="flex items-center gap-5">
                <form action="{{ route('home') }}" method="GET" class="hidden md:flex items-center bg-gray-100 px-3 py-2 rounded-sm border border-transparent focus-within:border-gray-400">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Produk..." class="bg-transparent border-none text-xs focus:ring-0 w-48 placeholder-gray-500">
                </form>

                <div class="flex items-center gap-4">
                    <div class="relative" x-data="{ userOpen: false }">
                        @auth
                            <button @click="userOpen = !userOpen" @click.away="userOpen = false" 
                                class="flex items-center gap-1 text-gray-700 hover:text-red-600 transition focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </button>

                            <div x-show="userOpen" x-transition class="absolute right-0 mt-3 w-48 bg-white border border-gray-100 rounded-md shadow-xl z-50 py-2" style="display: none;">
                                <div class="px-4 py-2 border-b border-gray-50">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase">Halo,</p>
                                    <p class="text-sm font-bold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                                </div>
                                <a href="{{ Auth::user()->hasRole('admin') ? route('admin.dashboard') : route('user.dashboard') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 border-t border-gray-50">Keluar</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </a>
                        @endauth
                    </div>

                    <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-red-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        @php $cartCount = session('cart') ? collect(session('cart'))->sum('qty') : 0; @endphp
                        @if ($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <button class="lg:hidden text-gray-700" @click="mobileMenu = !mobileMenu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenu"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenu" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="mobileMenu" x-transition class="lg:hidden bg-white border-t border-gray-100 shadow-inner" style="display: none;">
        <div class="px-4 py-6 space-y-4">
            <a href="{{ route('home') }}" class="block text-base font-bold uppercase {{ request()->routeIs('home') && !request('category') ? 'text-red-600' : 'text-gray-900' }}">Home</a>
            
            @foreach($categories as $category)
                <a href="{{ route('home', ['category' => $category->slug]) }}" 
                   class="block text-base font-bold uppercase {{ request('category') == $category->slug ? 'text-red-600' : 'text-gray-900' }}">
                    {{ $category->name }}
                </a>
            @endforeach

            @auth
                <a href="{{ Auth::user()->hasRole('admin') ? route('admin.dashboard') : route('user.dashboard') }}" class="block text-base font-bold uppercase text-gray-900">My Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block text-base font-bold uppercase text-gray-900">Login / Register</a>
            @endauth
            
            <div class="pt-4 border-t border-gray-50 space-y-3">
                <a href="#" class="block text-sm text-gray-500 font-medium">Bantuan</a>
                <a href="#" class="block text-sm text-gray-500 font-medium">Lokasi Toko</a>
            </div>
        </div>
    </div>
</header>
