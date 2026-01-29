@extends('layouts.app')

@section('title', 'Order Confirmed - Atlas Gaming')

@section('content')
<div class="py-24">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-24 h-24 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-10 shadow-2xl shadow-emerald-500/20">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
        </div>

        <h1 class="font-gaming text-4xl font-black uppercase tracking-tight mb-4">Order <span class="text-emerald-400">Deployed</span></h1>
        <p class="text-gray-400 text-lg mb-12">Transmission established. Your order <span class="text-white font-bold">#{{ $order->id }}</span> has been successfully logged into our systems.</p>

        <div class="gaming-card rounded-3xl p-8 border border-white/5 mb-12 text-left">
            <div class="flex flex-col md:flex-row justify-between gap-8">
                <div>
                    <h3 class="text-[10px] font-black font-gaming uppercase tracking-widest text-violet-400 mb-2">Primary Destination</h3>
                    <p class="text-white font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-gray-400 text-sm mt-1">{{ $order->shipping_address }}</p>
                    <p class="text-gray-400 text-sm">{{ $order->phone }}</p>
                </div>
                <div class="md:text-right">
                    <h3 class="text-[10px] font-black font-gaming uppercase tracking-widest text-violet-400 mb-2">Protocol Applied</h3>
                    <p class="text-white font-medium uppercase text-sm">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    <p class="text-3xl font-black font-gaming text-white mt-2">${{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-6">
            <a href="{{ route('orders.show', $order->id) }}" class="btn-primary px-8 py-4 rounded-xl font-gaming font-black uppercase text-xs tracking-widest text-white shadow-xl min-w-[200px]">
                Track Status
            </a>
            <a href="{{ route('shop.index') }}" class="bg-slate-800 hover:bg-slate-700 px-8 py-4 rounded-xl font-gaming font-black uppercase text-xs tracking-widest text-white transition-all min-w-[200px]">
                Back to Command
            </a>
        </div>

        <div class="mt-20 pt-12 border-t border-white/5">
            <p class="text-gray-500 text-xs">A digital receipt has been dispatched to your registered email address.</p>
        </div>
    </div>
</div>
@endsection
