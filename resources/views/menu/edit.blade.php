@extends('admin.layouts.app')

@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Edit Menu Makanan
    </h2>

    <!-- Notifikasi sukses -->
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Nama Menu -->
        <div class="mb-4">
            <label for="nama_menu" class="block text-gray-700">Description</label>
            <input type="text" name="description" id="description" value="{{ old('nama_menu', $menu->description) }}"
                class="w-full p-2 border border-gray-300 rounded-lg @error('description') border-red-500 @enderror">
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label for="harga" class="block text-gray-700">Harga</label>
            <input type="text" name="price" id="price" value="{{ old('price', $menu->price) }}"
                class="w-full p-2 border border-gray-300 rounded-lg @error('price') border-red-500 @enderror">
            @error('price')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Gambar -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Upload Gambar</label>
            <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded-lg">
            @if($menu->image)
            <div class="mt-2">
                <img src="{{ $menu->image }}" alt="Menu Image" class="w-32 h-32 rounded">
            </div>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="mb-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                Update Menu
            </button>
        </div>
    </form>
</div>
@endsection