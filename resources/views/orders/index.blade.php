@extends('layouts.app')

@section('title', 'Order History - Atlas Gaming')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-gaming text-3xl font-black uppercase tracking-tight mb-12">Mission <span class="text-violet-500">History</span></h1>

        @if($orders->count() > 0)
        <div class="gaming-card rounded-3xl overflow-hidden border border-white/5">
            <table class="w-full text-left">
                <thead class="bg-slate-800/50 border-b border-white/5">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400">Order Ref</th>
                        <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400">Deployment Date</th>
                        <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 text-center">Protocol Status</th>
                        <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 text-center">Value</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($orders as $order)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-6">
                            <span class="text-white font-gaming font-bold">#{{ $order->id }}</span>
                        </td>
                        <td class="px-6 py-6 text-gray-400 text-sm">
                            {{ $order->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-6 text-center">
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
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black font-gaming uppercase tracking-widest border {{ $class }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-6 text-center font-gaming font-bold text-white">
                            ${{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-6 text-right">
                            <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center gap-2 text-violet-400 hover:text-white text-xs font-bold transition-all group">
                                View Details
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @else
        <div class="text-center py-32 bg-slate-800/10 rounded-3xl border border-dashed border-white/10">
            <div class="w-24 h-24 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h2 class="font-gaming text-2xl font-bold uppercase text-white mb-4">No data found</h2>
            <p class="text-gray-500 mb-10 max-w-xs mx-auto">Your tactical history is empty. Deploy your first order to see it here.</p>
            <a href="{{ route('shop.index') }}" class="btn-primary px-8 py-4 rounded-full font-gaming font-black uppercase text-xs tracking-widest text-white shadow-xl">
                Start Mission
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
