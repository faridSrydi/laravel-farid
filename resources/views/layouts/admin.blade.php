<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LARACLO ADMIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Inter:wght@400;600;800&family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .uniqlo-font { font-family: 'Oswald', sans-serif; }
        .mono-font { font-family: 'Roboto Mono', monospace; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #000; }
        ::-webkit-scrollbar-thumb:hover { background: #333; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased min-h-screen flex flex-col">

<!-- Overlay -->
<div id="mobileOverlay" class="fixed inset-0 bg-black/40 z-40 hidden"></div>

<!-- Mobile Sidebar -->
<div id="mobileSidebar"
     class="fixed top-0 left-0 w-64 h-full bg-white z-50 transform -translate-x-full transition-transform duration-300 shadow-xl">

    <div class="h-20 flex items-center justify-between px-4 border-b">
        <div class="font-bold tracking-wide">LARACLO ADMIN</div>
        <button onclick="toggleSidebar()" class="text-2xl">&times;</button>
    </div>

    <div class="flex flex-col h-full">
        <a href="{{ route('admin.dashboard') }}"
           class="px-5 py-4 text-xs font-bold uppercase tracking-widest border-b
           {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            Overview
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="px-5 py-4 text-xs font-bold uppercase tracking-widest border-b
           {{ request()->routeIs('admin.categories*') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            Category
        </a>

        <a href="{{ route('admin.products.index') }}"
           class="px-5 py-4 text-xs font-bold uppercase tracking-widest border-b
           {{ request()->routeIs('admin.products*') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            Products
        </a>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto border-t">
            @csrf
            <button class="w-full text-left px-5 py-4 text-xs font-bold uppercase tracking-widest text-red-600 hover:bg-red-50">
                Logout
            </button>
        </form>
    </div>
</div>

<nav class="border-b border-gray-200 bg-white sticky top-0 z-30">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">

        <div class="flex items-center gap-4 md:gap-12">
            <!-- Hamburger -->
            <button onclick="toggleSidebar()" class="md:hidden text-2xl font-bold">
                ☰
            </button>

            <a href="{{ route('admin.dashboard') }}">
                <div class="w-12 h-12 bg-[#ED1C24] text-white flex flex-col items-center justify-center leading-none">
                    <span class="text-[10px] font-bold -mb-0.5">LARA</span>
                    <span class="text-[10px] font-bold">CLO</span>
                    <span class="text-[7px] font-medium mt-0.5 border-t border-white/40 pt-0.5 px-1">ADMIN</span>
                </div>
            </a>

            <div class="hidden md:flex h-20">
                <a href="{{ route('admin.dashboard') }}" 
                   class="h-full flex items-center px-4 text-xs font-bold uppercase tracking-[0.15em] border-b-4 
                   {{ request()->routeIs('admin.dashboard') ? 'border-[#ED1C24] text-black' : 'border-transparent text-gray-400 hover:text-black hover:border-gray-200' }}">
                    Overview
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                   class="h-full flex items-center px-4 text-xs font-bold uppercase tracking-[0.15em] border-b-4 
                   {{ request()->routeIs('admin.categories*') ? 'border-[#ED1C24] text-black' : 'border-transparent text-gray-400 hover:text-black hover:border-gray-200' }}">
                    Category
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="h-full flex items-center px-4 text-xs font-bold uppercase tracking-[0.15em] border-b-4 
                   {{ request()->routeIs('admin.products*') ? 'border-[#ED1C24] text-black' : 'border-transparent text-gray-400 hover:text-black hover:border-gray-200' }}">
                    Products
                </a>
            </div>
        </div>

        <div class="flex items-center gap-8">
            <div class="text-right hidden sm:block">
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Logged in as</p>
                <p class="text-xs font-bold uppercase tracking-wide text-black">{{ auth()->user()->name }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-black text-white px-5 py-2 text-[10px] font-bold uppercase tracking-widest hover:bg-[#ED1C24] transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<main class="flex-grow max-w-[1440px] w-full mx-auto px-4 lg:px-8 py-10">
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-gray-200 pb-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold uppercase tracking-tighter leading-none mb-2">@yield('title')</h1>
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em]">Management System Control Panel</p>
        </div>
        <div class="flex gap-3">
            @yield('actions')
        </div>
    </div>

    @yield('content')
</main>

<footer class="border-t border-gray-200 mt-auto bg-[#F4F4F4]">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            System Version 2.4.0 (Stable)
        </p>
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            &copy; {{ date('Y') }} LARACLO Enterprise.
        </p>
    </div>
</footer>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('mobileOverlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

document.getElementById('mobileOverlay').addEventListener('click', toggleSidebar);
</script>

</body>
</html>
