@extends('admin.layouts.app')

@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Create Menu Makanan
    </h2>

    <!-- Form untuk Create -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full px-6 py-4 bg-white dark:bg-gray-800">
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm" for="nama_menu">
                        Deskripsi
                    </label>
                    <input id="nama_menu" name="description" type="text" class="block w-full mt-1 text-sm form-input" placeholder="Masukkan nama menu">
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm" for="harga">
                        Harga
                    </label>
                    <input id="harga" name="price" type="text" class="block w-full mt-1 text-sm form-input" placeholder="Masukkan harga">
                    @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm" for="image">
                        Gambar
                    </label>
                    <input id="image" name="image" type="file" class="block w-full mt-1 text-sm form-input">
                    @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection