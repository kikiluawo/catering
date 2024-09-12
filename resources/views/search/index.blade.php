@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Menu Search Results</h1>

    <form method="GET" action="{{ route('search.index') }}" class="mb-6 flex items-center">
        <input type="text" name="search" placeholder="Search for menu..." class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm w-full max-w-md">
        <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-700">Search</button>
    </form>



    @forelse($menus as $menu)
    <div class="mb-6 p-4 border border-gray-300 rounded-lg shadow-sm bg-white">
        <div class="mb-4">
            <img src="{{ asset($menu->image) }}" alt="{{ $menu->description }}" class="w-full h-48 object-cover rounded-lg">
        </div>
        <h2 class="text-xl font-semibold">{{ $menu->description }}</h2>
        <p class="text-gray-700 mb-2">Price: Rp{{ number_format($menu->price, 2) }}</p>
        <p class="text-gray-500 mb-2">Merchant: {{ $menu->user->name }}</p>
        <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="flex items-center">
            @csrf
            <input type="number" name="quantity" value="0" min="0" class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm mr-2 w-24">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-700">Add to Cart</button>
        </form>
    </div>
    @empty
    <p class="text-gray-500">No menu items found.</p>
    @endforelse
</div>
@endsection