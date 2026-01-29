<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                @yield('page_title', 'Admin dashboard')
            </h2>
            <span class="text-xs uppercase tracking-widest text-gray-400">Admin</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 sm:px-6 lg:flex-row lg:px-8">
            <aside class="w-full rounded-lg border border-gray-200 bg-white px-4 py-5 shadow-sm lg:w-64">
                <nav class="space-y-2 text-sm">
                    <div class="font-semibold uppercase tracking-wide text-gray-400">Manage</div>
                    <a
                        href="{{ route('admin.categories.index') }}"
                        @class([
                            'flex items-center justify-between rounded-md px-3 py-2 transition',
                            'bg-gray-100 text-gray-900 shadow-inner' => request()->routeIs('admin.categories.*'),
                            'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('admin.categories.*'),
                        ])
                    >
                        <span>Categories</span>
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m9 5 7 7-7 7" />
                        </svg>
                    </a>
                    <a
                        href="{{ route('admin.products.index') }}"
                        @class([
                            'flex items-center justify-between rounded-md px-3 py-2 transition',
                            'bg-gray-100 text-gray-900 shadow-inner' => request()->routeIs('admin.products.*'),
                            'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('admin.products.*'),
                        ])
                    >
                        <span>Products</span>
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m9 5 7 7-7 7" />
                        </svg>
                    </a>
                    <a
                        href="{{ route('admin.orders.index') }}"
                        @class([
                            'flex items-center justify-between rounded-md px-3 py-2 transition',
                            'bg-gray-100 text-gray-900 shadow-inner' => request()->routeIs('admin.orders.*'),
                            'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('admin.orders.*'),
                        ])
                    >
                        <span>Orders</span>
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m9 5 7 7-7 7" />
                        </svg>
                    </a>
                    <a
                        href="{{ route('admin.users.index') }}"
                        @class([
                            'flex items-center justify-between rounded-md px-3 py-2 transition',
                            'bg-gray-100 text-gray-900 shadow-inner' => request()->routeIs('admin.users.*'),
                            'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('admin.users.*'),
                        ])
                    >
                        <span>Users</span>
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m9 5 7 7-7 7" />
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-4">
                        @csrf
                        <button type="submit" class="flex w-full items-center justify-center rounded-md border border-red-200 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50">Log out</button>
                    </form>
                </nav>
            </aside>

            <main class="w-full rounded-lg border border-gray-200 bg-white px-4 py-6 shadow-sm lg:flex-1">
                @if (session('success'))
                    <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</x-app-layout>
