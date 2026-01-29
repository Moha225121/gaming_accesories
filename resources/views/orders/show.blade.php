@extends('layouts.app')

@section('title', 'Order Details #' . $order->id . ' - Atlas Gaming')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <a href="{{ route('orders.index') }}" class="text-violet-400 hover:text-white text-xs font-bold flex items-center mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to History
                </a>
                <h1 class="font-gaming text-3xl font-black uppercase tracking-tight">Order <span class="text-violet-500">#{{ $order->id }}</span></h1>
                <p class="text-gray-500 mt-2">Placed on {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
            </div>
            
            <div class="flex items-center gap-4">
                @php
                    $statusClasses = [
                        'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                        'confirmed' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                        'processing' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20',
                        'shipped' => 'bg-violet-500/10 text-violet-500 border-violet-500/20',
                        'delivered' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                        'cancelled' => 'bg-red-500/10 text-red-500 border-red-500/20',
                    ];
                    $class = $statusClasses[$order->status] ?? 'bg-gray-500/10 text-gray-500 border-gray-500/20';
                @endphp
                <span class="inline-flex items-center px-6 py-2 rounded-xl text-xs font-black font-gaming uppercase tracking-widest border {{ $class }}">
                    {{ $order->status_label }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-8">
                <div class="gaming-card rounded-3xl overflow-hidden border border-white/5">
                    <div class="bg-slate-800/50 px-8 py-4 border-b border-white/5">
                        <h3 class="text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400">Deployed Gear</h3>
                    </div>
                    <div class="divide-y divide-white/5">
                        @foreach($order->orderItems as $item)
                        <div class="px-8 py-6 flex items-center gap-6">
                            <div class="w-16 h-16 bg-slate-800 rounded-xl flex-shrink-0 flex items-center justify-center overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-[8px] text-gray-600 font-bold uppercase">NA</div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-white font-bold leading-tight">{{ $item->product->name }}</h4>
                                <p class="text-[10px] text-gray-500 mt-1 font-gaming uppercase tracking-widest">{{ $item->product->category->name }} x {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-white font-gaming font-bold">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                <p class="text-[10px] text-gray-500">${{ number_format($item->price, 2) }} each</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="bg-slate-800/30 px-8 py-6 flex justify-between items-center">
                        <span class="font-gaming font-black uppercase text-xs tracking-widest text-white">Grand Total</span>
                        <span class="text-2xl font-black font-gaming text-violet-400 tracking-tighter">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                @if($order->notes)
                <div class="gaming-card rounded-3xl p-8 border border-white/5">
                    <h3 class="text-[10px] font-black font-gaming uppercase tracking-widest text-violet-400 mb-4">Transmission Notes</h3>
                    <p class="text-gray-400 text-sm italic">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Order Sidebar -->
            <div class="space-y-8">
                <div class="gaming-card rounded-3xl p-8 border border-white/5">
                    <h3 class="text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 mb-6">Delivery Details</h3>
                    <div class="space-y-6">
                        <div>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest block mb-1">Shipping Destination</span>
                            <p class="text-white text-sm font-medium">{{ $order->shipping_address }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest block mb-1">Contact Protocol</span>
                            <p class="text-white text-sm font-medium">{{ $order->phone }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest block mb-1">Payment Method</span>
                            <p class="text-white text-sm font-medium uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 border border-white/5 relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-white font-gaming font-black uppercase text-xs tracking-widest mb-4">Need Assistance?</h3>
                        <p class="text-gray-400 text-xs mb-6">Our tactical support team is available 24/7 for any deployment issues.</p>
                        <a href="#" class="inline-block text-violet-400 hover:text-white text-xs font-bold transition-all underline">Contact Support</a>
                    </div>
                    <div class="absolute -right-8 -bottom-8 opacity-10">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
