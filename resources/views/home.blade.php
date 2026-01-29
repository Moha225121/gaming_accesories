@extends('layouts.app')

@section('title', 'Welcome to Atlas Gaming - Premium Accessories')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-[80vh]">
        <div class="absolute top-0 w-full h-full bg-center bg-cover bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1542751371-adc38448a05e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
            <span id="blackOverlay" class="w-full h-full absolute opacity-70 bg-slate-950"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12">
                        <h1 class="text-white font-gaming font-black text-5xl md:text-7xl leading-tight uppercase tracking-tighter">
                            Level Up Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-indigo-500">Gaming Kit</span>
                        </h1>
                        <p class="mt-6 text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">
                            Discover the ultimate selection of professional gaming gear. Engineered for performance, designed for comfort, and built to win.
                        </p>
                        <div class="mt-10 flex flex-wrap justify-center gap-4">
                            <a href="{{ route('shop.index') }}" class="btn-primary px-8 py-4 rounded-full font-gaming font-bold text-sm uppercase tracking-widest text-white shadow-xl">
                                Explore Store
                            </a>
                            <a href="#featured" class="bg-white/10 hover:bg-white/20 backdrop-filter backdrop-blur-sm border border-white/10 px-8 py-4 rounded-full font-gaming font-bold text-sm uppercase tracking-widest text-white transition-all">
                                Featured Gear
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <section class="py-24 bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-gaming text-3xl font-bold uppercase tracking-wider">Top <span class="text-violet-500">Categories</span></h2>
                <div class="h-1 w-20 bg-violet-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
                @foreach($categories as $category)
                <a href="{{ route('shop.index', ['category' => $category->id]) }}" class="gaming-card p-6 rounded-2xl flex flex-col items-center text-center group">
                    <div class="w-12 h-12 rounded-lg bg-violet-600/10 flex items-center justify-center mb-4 group-hover:bg-violet-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-violet-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold font-gaming uppercase tracking-tighter">{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div>
                    <h2 class="font-gaming text-3xl font-bold uppercase tracking-wider">Featured <span class="text-violet-500">Gear</span></h2>
                    <p class="text-gray-400 mt-2">The most popular items this week.</p>
                </div>
                <a href="{{ route('shop.index') }}" class="text-violet-400 font-bold flex items-center hover:text-violet-300 transition-colors">
                    View Full Store
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="gaming-card rounded-3xl overflow-hidden flex flex-col h-full group">
                    <div class="relative aspect-square bg-slate-800 overflow-hidden">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-800 text-gray-500 italic">
                                No Image
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-violet-600 text-[10px] font-black font-gaming px-2 py-1 rounded uppercase tracking-wider shadow-lg">NEW</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-violet-400 text-[10px] font-black font-gaming uppercase tracking-widest mb-1">{{ $product->category->name }}</span>
                        <h3 class="text-lg font-bold mb-2 line-clamp-1 group-hover:text-violet-400 transition-colors">{{ $product->name }}</h3>
                        <p class="text-gray-400 text-sm line-clamp-2 mb-6 flex-grow">{{ $product->description }}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-2xl font-black font-gaming text-white">${{ number_format($product->price, 2) }}</span>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-3 bg-violet-600 rounded-xl hover:bg-violet-700 transition-colors shadow-lg shadow-violet-600/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-24 bg-violet-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-gaming text-white uppercase mb-4 tracking-wider">Fast Delivery</h3>
                    <p class="text-violet-100">Get your gear delivered at lightning speed directly to your doorstep.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 14.535a11.996 11.996 0 0010.607 10.467l1.234-.145a11.996 11.996 0 0010.607-10.466l-1.234-.145z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-gaming text-white uppercase mb-4 tracking-wider">Secure Payment</h3>
                    <p class="text-violet-100">Multiple secure payment methods supported for your peace of mind.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-gaming text-white uppercase mb-4 tracking-wider">24/7 Support</h3>
                    <p class="text-violet-100">Our support team is always ready to help you with any inquiries.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-slate-950">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-gaming text-4xl font-black uppercase mb-8 tracking-tighter">Ready to <span class="text-violet-500">Join the Elite?</span></h2>
            <p class="text-gray-400 mb-10 text-lg">Create an account today and get access to exclusive products and member-only discounts.</p>
            <a href="{{ route('register') }}" class="btn-primary px-10 py-5 rounded-full font-gaming font-bold text-sm uppercase tracking-widest text-white shadow-2xl">
                Create Free Account
            </a>
        </div>
    </section>
</div>
@endsection
