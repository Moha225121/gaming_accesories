@extends('layouts.app')

@section('title', 'Gaming Store - Discover Your Next Upgrade')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header & Breadcrumbs -->
        <nav class="flex mb-8 text-sm text-gray-500 font-medium" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="hover:text-violet-400">Home</a></li>
                <li class="flex items-center space-x-2">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-300">Shop</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="font-gaming text-4xl font-black uppercase tracking-tight">Gaming <span class="text-violet-500">Gear</span></h1>
                <p class="text-gray-400 mt-2">Browse our full collection of professional grade accessories.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-4">
                <form action="{{ route('shop.index') }}" method="GET" class="flex items-center flex-grow md:flex-grow-0">
                    <div class="relative w-full md:w-64">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search gear..." class="w-full bg-slate-800 border-none rounded-xl py-3 pl-4 pr-10 text-sm focus:ring-2 focus:ring-violet-500">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <select onchange="window.location.href=this.value" class="bg-slate-800 border-none rounded-xl py-3 pl-4 pr-10 text-sm focus:ring-2 focus:ring-violet-500 cursor-pointer">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest Arrivals</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-64 flex-shrink-0">
                <div class="sticky top-24">
                    <div class="mb-8">
                        <h3 class="font-gaming text-sm font-bold uppercase tracking-widest text-white mb-6">Categories</h3>
                        <div class="space-y-3">
                            <a href="{{ route('shop.index') }}" class="flex items-center justify-between p-3 rounded-xl {{ !request('category') ? 'bg-violet-600 text-white shadow-lg shadow-violet-600/20' : 'bg-slate-800/50 text-gray-400 hover:text-white hover:bg-slate-800' }} transition-all">
                                <span class="text-sm font-bold">All Gears</span>
                                <span class="text-[10px] opacity-60">PRO</span>
                            </a>
                            @foreach($categories as $category)
                            <a href="{{ route('shop.index', ['category' => $category->id]) }}" class="flex items-center justify-between p-3 rounded-xl {{ request('category') == $category->id ? 'bg-violet-600 text-white shadow-lg shadow-violet-600/20' : 'bg-slate-800/50 text-gray-400 hover:text-white hover:bg-slate-800' }} transition-all">
                                <span class="text-sm font-bold">{{ $category->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-40" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-violet-600 to-indigo-700 rounded-3xl p-6 overflow-hidden relative">
                        <div class="relative z-10">
                            <h4 class="font-gaming font-black text-xl text-white leading-tight mb-2">PRO MEMBER SPECIAL</h4>
                            <p class="text-violet-100 text-xs mb-6">Get 15% off on your first order when you sign up.</p>
                            <a href="{{ route('register') }}" class="inline-block bg-white text-violet-600 px-4 py-2 rounded-lg text-[10px] font-black font-gaming tracking-widest uppercase shadow-xl hover:scale-105 transition-transform">Claim Offer</a>
                        </div>
                        <div class="absolute -right-4 -bottom-4 opacity-20 transform rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="flex-grow">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach($products as $product)
                        <div class="gaming-card rounded-3xl overflow-hidden flex flex-col h-full group">
                            <a href="{{ route('shop.show', $product->id) }}" class="relative aspect-[4/3] bg-slate-800 overflow-hidden block">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-800 text-gray-500 italic">
                                        No Image
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                                        <span class="bg-orange-500 text-[10px] font-black font-gaming px-2 py-1 rounded-lg uppercase tracking-wider shadow-lg">Low Stock</span>
                                    @elseif($product->stock_quantity == 0)
                                        <span class="bg-red-600 text-[10px] font-black font-gaming px-2 py-1 rounded-lg uppercase tracking-wider shadow-lg">Sold Out</span>
                                    @endif
                                </div>
                            </a>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-violet-400 text-[10px] font-black font-gaming uppercase tracking-widest">{{ $product->category->name }}</span>
                                    <div class="flex items-center text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-[10px] font-bold ml-1">4.9</span>
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold mb-2 group-hover:text-violet-400 transition-colors">
                                    <a href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a>
                                </h3>
                                <p class="text-gray-400 text-sm line-clamp-2 mb-6 flex-grow">{{ $product->description }}</p>
                                
                                <div class="flex items-center justify-between mt-auto">
                                    <span class="text-2xl font-black font-gaming text-white">${{ number_format($product->price, 2) }}</span>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="group/btn flex items-center justify-center p-3 rounded-xl bg-slate-800 hover:bg-violet-600 transition-all duration-300" {{ $product->stock_quantity == 0 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover/btn:text-white group-hover/btn:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-16">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-20 bg-slate-800/20 rounded-3xl border border-dashed border-white/10">
                        <div class="w-16 h-16 bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-6 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold font-gaming text-white uppercase mb-2">No gear found</h3>
                        <p class="text-gray-500">Try adjusting your filters or search terms.</p>
                        <a href="{{ route('shop.index') }}" class="mt-6 inline-block text-violet-400 hover:text-white transition-colors">Clear all filters</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
