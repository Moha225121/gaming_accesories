@extends('admin.layout')

@section('page_title', 'Create Category')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">&larr; Back to categories</a>
</div>

<div class="max-w-xl">
    <h3 class="text-2xl font-semibold text-gray-800">Create category</h3>
    <p class="mt-2 text-sm text-gray-500">Give the category a meaningful name and optional description.</p>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-6 space-y-5">
        @csrf

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

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. Keyboards" />
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Optional details shown when browsing products">{{ old('description') }}</textarea>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">Save category</button>
            <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-700">Cancel</a>
        </div>
    </form>
</div>
@endsection
