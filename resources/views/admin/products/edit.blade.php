@extends('admin.layout')

@section('page_title', 'Edit Product')

@section('content')
<div class="mb-6">
	<a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">&larr; Back to products</a>
</div>

<div class="max-w-3xl">
	<h3 class="text-2xl font-semibold text-gray-800">Edit product</h3>
	<p class="mt-2 text-sm text-gray-500">Update the product information, pricing, and inventory levels.</p>

	<form method="POST" action="{{ route('admin.products.update', $product) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		@if ($errors->any())
			<div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
				<p class="font-semibold">Please fix the following:</p>
				<ul class="mt-2 list-inside list-disc space-y-1">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div class="grid gap-6 sm:grid-cols-2">
			<div class="sm:col-span-2">
				<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
				<input id="name" name="name" type="text" value="{{ old('name', $product->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
			</div>

			<div>
				<label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
				<select id="category_id" name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					@foreach ($categories as $cat)
						<option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
					@endforeach
				</select>
			</div>

			<div>
				<label for="image" class="block text-sm font-medium text-gray-700">Update Image</label>
				<input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
				@if($product->image)
					<div class="mt-2">
						<p class="text-xs text-gray-500 mb-1">Current image:</p>
						<img src="{{ $product->image_url }}" alt="" class="h-20 w-20 object-cover rounded-md border border-gray-200">
					</div>
				@endif
			</div>

			<div class="grid gap-6 sm:grid-cols-2 sm:col-span-2">
				<div>
					<label for="price" class="block text-sm font-medium text-gray-700">Price</label>
					<div class="mt-1 flex rounded-md shadow-sm">
						<span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500">$</span>
						<input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price', $product->price) }}" required class="block w-full rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
					</div>
				</div>
				<div>
					<label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock quantity</label>
					<input id="stock_quantity" name="stock_quantity" type="number" min="0" step="1" value="{{ old('stock_quantity', $product->stock_quantity) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
				</div>
			</div>
		</div>

		<div>
			<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
			<textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
		</div>

		<div class="flex items-center gap-3">
			<button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">Update product</button>
			<a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-700">Cancel</a>
		</div>
	</form>
</div>
@endsection
