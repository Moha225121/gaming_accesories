@extends('admin.layout')

@section('page_title', 'Command Center')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-900">System Overview</h3>
            <p class="text-sm text-gray-500 mt-1">Real-time status of your gaming accessories empire.</p>
        </div>
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest bg-gray-100 px-3 py-1 rounded-full border border-gray-200">
            Last updated: {{ now()->format('H:i') }}
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <div>
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Orders</h2>
                    <p class="text-2xl font-black text-gray-900">{{ \App\Models\Order::count() }}</p>
                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">View and manage orders &rarr;</a>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div>
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Active Products</h2>
                    <p class="text-2xl font-black text-gray-900">{{ \App\Models\Product::count() }}</p>
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">Manage inventory &rarr;</a>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Users</h2>
                    <p class="text-2xl font-black text-gray-900">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">Manage accounts &rarr;</a>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                </div>
                <div>
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Categories</h2>
                    <p class="text-2xl font-black text-gray-900">{{ \App\Models\Category::count() }}</p>
                </div>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">Define structure &rarr;</a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Recent Orders</h4>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">View All</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse(\App\Models\Order::latest()->take(5)->get() as $order)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-600">
                            #{{ $order->id }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->user->name }}</p>
                            <p class="text-[10px] text-gray-500 uppercase font-bold">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-700">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <p class="text-sm text-gray-500 italic">No orders yet.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-indigo-700 rounded-xl p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-200">
            <div class="relative z-10 max-w-sm">
                <h4 class="text-2xl font-black uppercase tracking-tight mb-4">Launch Site</h4>
                <p class="text-indigo-100 text-sm mb-8 leading-relaxed">System implementation is complete. Your premium gaming accessories e-commerce platform is ready for terminal deployment.</p>
                <a href="{{ route('home') }}" class="inline-block bg-white text-indigo-700 px-6 py-3 rounded-lg font-bold text-sm shadow-lg hover:scale-105 transition-transform">
                    View Public Front
                </a>
            </div>
            <div class="absolute -right-12 -bottom-12 opacity-10">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
        </div>
    </div>
</div>
@endsection
