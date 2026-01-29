@extends('layouts.app')

@section('title', 'Secure Checkout - Atlas Gaming')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-gaming text-3xl font-black uppercase tracking-tight mb-12">Secure <span class="text-violet-500">Checkout</span></h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Checkout Form -->
                <div class="flex-grow space-y-8">
                    <div class="gaming-card rounded-3xl overflow-hidden p-8 border border-white/5">
                        <h2 class="font-gaming text-sm font-bold uppercase tracking-[0.2em] text-violet-400 mb-8">Delivery Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-1">
                                <label for="phone" class="block text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 mb-2 ml-1">Contact Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full bg-slate-800 border-none rounded-xl py-4 px-6 text-white text-sm focus:ring-2 focus:ring-violet-500 transition-all" placeholder="e.g. +1 234 567 8900" required>
                                @error('phone') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_address" class="block text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 mb-2 ml-1">Shipping Address</label>
                                <textarea name="shipping_address" id="shipping_address" rows="3" class="w-full bg-slate-800 border-none rounded-2xl py-4 px-6 text-white text-sm focus:ring-2 focus:ring-violet-500 transition-all resize-none" placeholder="Street name, building number, city, postal code..." required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                                @error('shipping_address') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="notes" class="block text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 mb-2 ml-1">Order Notes (Optional)</label>
                                <textarea name="notes" id="notes" rows="2" class="w-full bg-slate-800 border-none rounded-2xl py-4 px-6 text-white text-sm focus:ring-2 focus:ring-violet-500 transition-all resize-none" placeholder="Special instructions for delivery...">{{ old('notes') }}</textarea>
                                @error('notes') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="gaming-card rounded-3xl overflow-hidden p-8 border border-white/5">
                        <h2 class="font-gaming text-sm font-bold uppercase tracking-[0.2em] text-violet-400 mb-8">Payment Protocol</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex p-6 cursor-pointer rounded-2xl bg-slate-800/50 border-2 border-transparent transition-all hover:bg-slate-800 has-[:checked]:border-violet-500 has-[:checked]:bg-violet-500/10 group">
                                <input type="radio" name="payment_method" value="cash_on_delivery" class="hidden" checked>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center group-hover:bg-slate-700 transition-colors">
                                        <svg class="w-6 h-6 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block font-gaming font-black uppercase text-xs tracking-widest text-white">Cash on Delivery</span>
                                        <span class="block text-[10px] text-gray-500 mt-1">Pay when item arrives</span>
                                    </div>
                                </div>
                            </label>

                            <label class="relative flex p-6 cursor-pointer rounded-2xl bg-slate-800/50 border-2 border-transparent transition-all hover:bg-slate-800 has-[:checked]:border-violet-500 has-[:checked]:bg-violet-500/10 group">
                                <input type="radio" name="payment_method" value="pay_on_pickup" class="hidden">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center group-hover:bg-slate-700 transition-colors">
                                        <svg class="w-6 h-6 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <div>
                                        <span class="block font-gaming font-black uppercase text-xs tracking-widest text-white">Pay on Pickup</span>
                                        <span class="block text-[10px] text-gray-500 mt-1">In-store collection</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Order Sidebar -->
                <div class="w-full lg:w-96">
                    <div class="gaming-card rounded-3xl p-8 border border-white/5 sticky top-24">
                        <h2 class="font-gaming text-xl font-bold uppercase tracking-wider mb-8 text-white">Order Review</h2>
                        
                        <div class="space-y-4 mb-8">
                            @foreach($cart as $id => $details)
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-slate-800 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                    @if($details['image'])
                                        <img src="{{ asset('storage/products/'.$details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="text-[6px] text-gray-600 font-bold uppercase">NA</div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-grow">
                                    <h4 class="text-xs font-bold text-white truncate">{{ $details['name'] }}</h4>
                                    <span class="text-[10px] text-gray-500">Qty: {{ $details['quantity'] }}</span>
                                </div>
                                <span class="text-xs font-bold text-gray-300">
                                    ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                </span>
                            </div>
                            @endforeach
                        </div>

                        <div class="space-y-4 mb-8 pt-8 border-t border-white/5">
                            <div class="flex justify-between text-gray-400">
                                <span class="text-xs">Subtotal</span>
                                <span class="font-bold text-white text-xs">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span class="text-xs">Shipping</span>
                                <span class="text-emerald-400 font-bold uppercase text-[10px] tracking-widest">Free</span>
                            </div>
                            <div class="h-[1px] bg-white/5 my-2"></div>
                            <div class="flex justify-between items-end">
                                <span class="text-white font-gaming text-xs font-bold uppercase tracking-widest">Total</span>
                                <span class="text-2xl font-black font-gaming text-violet-400 tracking-tighter">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary block w-full py-4 rounded-xl font-gaming font-black uppercase text-sm tracking-widest text-white shadow-2xl">
                            Deploy Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
