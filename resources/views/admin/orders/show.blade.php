@extends('admin.layout')

@section('page_title', 'Order details: #' . $order->id)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center mb-4 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Orders
            </a>
            <h3 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h3>
            <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
        </div>
        
        <div class="flex items-center gap-3">
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex items-center gap-2">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach(\App\Models\Order::STATUSES as $val => $label)
                        <option value="{{ $val }}" {{ $order->status == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                    Update Status
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Order Items</h4>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-500 uppercase tracking-widest">Product</th>
                            <th class="px-6 py-3 text-center text-[10px] font-bold text-gray-500 uppercase tracking-widest">Quantity</th>
                            <th class="px-6 py-3 text-right text-[10px] font-bold text-gray-500 uppercase tracking-widest">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-gray-100 overflow-hidden border border-gray-200 flex items-center justify-center">
                                        @if($item->product->image)
                                            <img src="{{ $item->product->image_url }}" alt="" class="max-h-full max-w-full object-contain">
                                        @else
                                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->product->category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700 font-medium">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-bold text-gray-900">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50/50">
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-right text-sm font-bold text-gray-900">Grand Total</td>
                            <td class="px-6 py-4 text-right text-lg font-black text-indigo-700">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @if($order->notes)
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Customer Notes</h4>
                <p class="text-sm text-gray-600 bg-gray-50 p-4 rounded-lg italic border border-gray-100">
                    "{{ $order->notes }}"
                </p>
            </div>
            @endif
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-8">
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-6 pb-2 border-b border-gray-100">Customer Details</h4>
                <div class="space-y-4">
                    <div>
                        <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Name</span>
                        <p class="text-sm font-medium text-gray-900">{{ $order->user->name }}</p>
                    </div>
                    <div>
                        <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Email</span>
                        <a href="mailto:{{ $order->user->email }}" class="text-sm font-medium text-indigo-600 hover:underline">{{ $order->user->email }}</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-6 pb-2 border-b border-gray-100">Delivery Information</h4>
                <div class="space-y-4">
                    <div>
                        <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Phone Number</span>
                        <p class="text-sm font-medium text-gray-900">{{ $order->phone }}</p>
                    </div>
                    <div>
                        <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Shipping Address</span>
                        <p class="text-sm font-medium text-gray-900 leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Payment Method</span>
                        <p class="text-sm font-medium text-gray-900 uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h4 class="text-blue-800 font-bold text-sm mb-2">Internal Procedure</h4>
                <p class="text-blue-600 text-xs">Verify payment status and inventory availability before moving the order to "Processing" or "Shipped".</p>
            </div>
        </div>
    </div>
</div>
@endsection
