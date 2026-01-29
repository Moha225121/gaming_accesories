@extends('admin.layout')

@section('page_title', 'Products')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h3 class="text-2xl font-semibold text-gray-800">Products</h3>
        <p class="text-sm text-gray-500">Manage the products available in your storefront.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">
        Add Product
    </a>
</div>

@if($products->isEmpty())
    <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 px-6 py-16 text-center">
        <h4 class="text-lg font-medium text-gray-700">No products yet</h4>
        <p class="mt-2 text-sm text-gray-500">Create your first product to start building the catalogue.</p>
        <div class="mt-5">
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">New Product</a>
        </div>
    </div>
@else
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Category</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Price</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Stock</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach($products as $product)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ optional($product->category)->name ?? 'Unassigned' }}</td>
                        <td class="px-4 py-3 text-right text-sm tabular-nums text-gray-700">${{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3 text-right text-sm tabular-nums text-gray-700">{{ number_format($product->stock_quantity) }}</td>
                        <td class="px-4 py-3 text-right text-sm">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center rounded-md border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:bg-gray-100">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center rounded-md border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
