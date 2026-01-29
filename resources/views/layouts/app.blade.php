<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Gaming Accessories Store')</title>
    <meta name="description" content="@yield('meta_description', 'Your one-stop shop for premium gaming accessories.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <style>
        :root {
            --primary: #8b5cf6;
            --primary-dark: #6d28d9;
            --accent: #10b981;
            --dark-bg: #0f172a;
            --dark-surface: #1e293b;
            --glass: rgba(30, 41, 59, 0.7);
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--dark-bg);
            color: #f8fafc;
        }
        
        .font-gaming {
            font-family: 'Orbitron', sans-serif;
        }
        
        .glass-nav {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .gaming-card {
            background: var(--dark-surface);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .gaming-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(139, 92, 246, 0.5);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            filter: brightness(1.1);
            transform: scale(1.02);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-black font-gaming tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-indigo-500">
                            ATLAS<span class="text-white">GAMING</span>
                        </span>
                    </a>
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('home') ? 'text-violet-400 border-b-2 border-violet-400' : 'text-gray-300 hover:text-white' }}">
                            Home
                        </a>
                        <a href="{{ route('shop.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('shop.*') ? 'text-violet-400 border-b-2 border-violet-400' : 'text-gray-300 hover:text-white' }}">
                            Shop
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Search Trigger (Desktop) -->
                    <form action="{{ route('shop.index') }}" method="GET" class="hidden md:flex relative">
                        <input type="text" name="search" placeholder="Search accessories..." class="bg-slate-800 border-none rounded-full py-1.5 pl-4 pr-10 text-sm focus:ring-2 focus:ring-violet-500 w-48 lg:w-64 transition-all">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="p-2 text-gray-300 hover:text-white relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-violet-600 rounded-full">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- Authentication Links -->
                    @auth
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-slate-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @if(auth()->user()->isAdmin())
                                        <x-dropdown-link :href="route('admin.dashboard')">
                                            {{ __('Admin Dashboard') }}
                                        </x-dropdown-link>
                                    @endif
                                    <x-dropdown-link :href="route('dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('orders.index')">
                                        {{ __('My Orders') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white">Log in</a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold bg-violet-600 hover:bg-violet-700 px-4 py-2 rounded-lg transition-colors">Sign up</a>
                    @endauth

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-100 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="bg-red-500/20 border border-red-500 text-red-100 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-white/5 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-black font-gaming tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-indigo-500">
                        ATLAS<span class="text-white">GAMING</span>
                    </span>
                    <p class="mt-4 text-gray-400 max-w-sm">
                        Experience gaming redefined with our premium collection of accessories. From high-performance peripherals to ergonomic comfort, we have everything you need to dominate the game.
                    </p>
                </div>
                <div>
                    <h3 class="font-gaming text-sm font-bold tracking-wider text-white uppercase">Shop</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ route('shop.index') }}" class="text-gray-400 hover:text-violet-400 transition-colors">All Products</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 1]) }}" class="text-gray-400 hover:text-violet-400 transition-colors">Headsets</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 2]) }}" class="text-gray-400 hover:text-violet-400 transition-colors">Keyboards</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 3]) }}" class="text-gray-400 hover:text-violet-400 transition-colors">Mice</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-gaming text-sm font-bold tracking-wider text-white uppercase">Company</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-violet-400 transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-violet-400 transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-violet-400 transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-violet-400 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-white/5 text-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Atlas Gaming Company. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
