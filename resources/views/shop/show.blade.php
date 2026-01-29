@extends('layouts.app')

@section('title', $product->name . ' - Atlas Gaming Store')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm text-gray-500 font-medium" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="hover:text-violet-400">Home</a></li>
                <li class="flex items-center space-x-2">
                    <svg class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('shop.index') }}" class="hover:text-violet-400">Shop</a>
                </li>
                <li class="flex items-center space-x-2">
                    <svg class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-300">{{ $product->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12 lg:items-start">
            <!-- Product Images -->
            <div class="w-full lg:w-1/2 space-y-4">
                <div class="gaming-card rounded-3xl overflow-hidden aspect-square bg-slate-800 flex items-center justify-center relative">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-8">
                    @else
                        <div class="text-gray-500 italic text-2xl font-gaming uppercase tracking-widest opacity-20">NO VISUAL LOADED</div>
                    @endif
                    <div class="absolute top-6 left-6">
                        <span class="bg-violet-600 text-[10px] font-black font-gaming px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-2xl">Premium Edition</span>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="w-full lg:w-1/2">
                <div class="mb-8">
                    <span class="text-violet-400 font-gaming font-black text-xs uppercase tracking-[0.2em] mb-3 block">{{ $product->category->name }}</span>
                    <h1 class="text-4xl md:text-5xl font-black font-gaming uppercase tracking-tighter text-white mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-6 mb-8">
                        <span class="text-4xl font-black font-gaming text-white">${{ number_format($product->price, 2) }}</span>
                        <div class="h-8 w-[1px] bg-white/10"></div>
                        <div class="flex items-center">
                            @if($product->stock_quantity > 0)
                                <div class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></div>
                                <span class="text-emerald-400 text-sm font-bold uppercase tracking-widest">In Stock ({{ $product->stock_quantity }} units)</span>
                            @else
                                <div class="w-2 h-2 rounded-full bg-red-500 mr-2"></div>
                                <span class="text-red-500 text-sm font-bold uppercase tracking-widest">Out of Stock</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl bg-slate-800/50 border border-white/5 mb-8">
                        <h3 class="font-gaming text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Description</h3>
                        <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    @if($product->stock_quantity > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="flex items-center gap-4">
                            <div class="flex items-center bg-slate-800 rounded-xl p-1 border border-white/5">
                                <button type="button" onclick="decrementQty()" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                </button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-16 bg-transparent border-none text-center focus:ring-0 font-bold text-white">
                                <button type="button" onclick="incrementQty()" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </button>
                            </div>
                            <button type="submit" class="btn-primary flex-grow py-4 rounded-xl font-gaming font-black uppercase text-sm tracking-widest text-white shadow-2xl flex items-center justify-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add to Cart
                            </button>
                        </div>
                    </form>
                    @endif
                </div>

                <!-- Features list -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-12 pt-12 border-t border-white/5">
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm">Official Warranty</h4>
                            <p class="text-gray-500 text-xs mt-1">12 Months direct from Atlas Company.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-violet-500/10 rounded-lg">
                            <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm">Instant Ship</h4>
                            <p class="text-gray-500 text-xs mt-1">Dispatched within 24 hours of confirmation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-32">
            <div class="text-center mb-12">
                <h2 class="font-gaming text-2xl font-bold uppercase tracking-wider">Related <span class="text-violet-500">Gear</span></h2>
                <div class="h-1 w-16 bg-violet-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $relProduct)
                <div class="gaming-card rounded-2xl overflow-hidden flex flex-col h-full group">
                    <a href="{{ route('shop.show', $relProduct->id) }}" class="relative aspect-square bg-slate-800 overflow-hidden block">
                        @if($relProduct->image)
                            <img src="{{ $relProduct->image_url }}" alt="{{ $relProduct->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-600 text-[10px] font-gaming uppercase tracking-widest">No Image</div>
                        @endif
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <span class="text-violet-400 text-[10px] font-black font-gaming uppercase tracking-widest mb-1">{{ $relProduct->category->name }}</span>
                        <h3 class="text-sm font-bold mb-4 line-clamp-1">
                            <a href="{{ route('shop.show', $relProduct->id) }}" class="hover:text-violet-400 transition-colors">{{ $relProduct->name }}</a>
                        </h3>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-lg font-black font-gaming text-white">${{ number_format($relProduct->price, 2) }}</span>
                            <form action="{{ route('cart.add', $relProduct->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 bg-slate-800 rounded-lg hover:bg-violet-600 transition-all">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function incrementQty() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.getAttribute('max'));
    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
    }
}

function decrementQty() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>
@endsection
