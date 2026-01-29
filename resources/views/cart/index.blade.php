@extends('layouts.app')

@section('title', 'Shopping Cart - Atlas Gaming')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-gaming text-3xl font-black uppercase tracking-tight mb-12">Shopping <span class="text-violet-500">Cart</span></h1>

        @if(count($cart) > 0)
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Cart Items -->
            <div class="flex-grow">
                <div class="gaming-card rounded-3xl overflow-hidden border border-white/5">
                    <table class="w-full text-left">
                        <thead class="bg-slate-800/50 border-b border-white/5">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400">Product</th>
                                <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 text-center">Price</th>
                                <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 text-center">Quantity</th>
                                <th class="px-6 py-4 text-[10px] font-black font-gaming uppercase tracking-widest text-gray-400 text-right">Subtotal</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($cart as $id => $details)
                            <tr data-id="{{ $id }}">
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-20 bg-slate-800 rounded-2xl flex-shrink-0 flex items-center justify-center overflow-hidden">
                                            @if($details['image'])
                                                <img src="{{ asset('storage/products/'.$details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="text-[8px] text-gray-600 font-bold uppercase tracking-tighter">No View</div>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-violet-400 text-[10px] font-black font-gaming uppercase tracking-widest mb-1">{{ $details['category'] }}</span>
                                            <h3 class="text-white font-bold leading-tight">{{ $details['name'] }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center font-bold text-gray-300">
                                    ${{ number_format($details['price'], 2) }}
                                </td>
                                <td class="px-6 py-6" data-th="Quantity">
                                    <div class="flex items-center justify-center">
                                        <div class="flex items-center bg-slate-800 rounded-xl p-0.5 border border-white/5">
                                            <input type="number" value="{{ $details['quantity'] }}" min="1" class="update-cart w-16 bg-transparent border-none text-center focus:ring-0 font-bold text-white py-1">
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-right font-black font-gaming text-white">
                                    ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                </td>
                                <td class="px-6 py-6 text-right">
                                    <button class="remove-from-cart p-2 text-gray-500 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5 focus:outline-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('shop.index') }}" class="text-gray-400 hover:text-white font-bold text-sm flex items-center transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Continue Shopping
                    </a>
                    
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500/60 hover:text-red-500 text-sm font-bold transition-colors">
                            Clear Entire Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- Summary -->
            <div class="w-full lg:w-96">
                <div class="gaming-card rounded-3xl p-8 border border-white/5 sticky top-24">
                    <h2 class="font-gaming text-xl font-bold uppercase tracking-wider mb-8 text-white">Summary</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-400">
                            <span class="text-sm">Subtotal</span>
                            <span class="font-bold text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span class="text-sm">Shipping</span>
                            <span class="text-emerald-400 font-bold uppercase text-[10px] tracking-widest">Free for PRO</span>
                        </div>
                        <div class="h-[1px] bg-white/5 my-2"></div>
                        <div class="flex justify-between items-end">
                            <span class="text-white font-gaming text-sm font-bold uppercase tracking-widest">Grand Total</span>
                            <span class="text-3xl font-black font-gaming text-violet-400 tracking-tighter">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn-primary block w-full py-4 rounded-xl font-gaming font-black uppercase text-sm tracking-[0.2em] text-white text-center shadow-2xl hover:scale-[1.02] transition-transform">
                        Verify & Checkout
                    </a>

                    <div class="mt-8 pt-8 border-t border-white/5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-white text-[10px] font-black uppercase tracking-widest">Secure Payment</h4>
                                <p class="text-gray-500 text-[10px]">End-to-end encrypted confirmation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-32 bg-slate-800/10 rounded-3xl border border-dashed border-white/10">
            <div class="w-24 h-24 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h2 class="font-gaming text-2xl font-bold uppercase text-white mb-4">Inventory is empty</h2>
            <p class="text-gray-500 mb-10 max-w-xs mx-auto">Looks like you haven't added any premium gear to your cart yet.</p>
            <a href="{{ route('shop.index') }}" class="btn-primary px-8 py-4 rounded-full font-gaming font-black uppercase text-xs tracking-widest text-white shadow-xl">
                Go to Shop
            </a>
        </div>
        @endif
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('cart.update') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Are you sure you want to remove this item?")) {
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
@endsection
