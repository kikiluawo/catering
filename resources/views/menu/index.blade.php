@extends('admin.layouts.app')

@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Menu Makanan
    </h2>

    <div class="mb-4">
        <a href="{{ route('menu.create') }}"
            class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-700">
            Create Menu
        </a>
    </div>

    <!-- Table with dynamic data -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table id="dataTable" class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Nama Menu</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($menus as $menu)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            <p class="font-semibold">{{ $menu->description }}</p>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <img src="{{ $menu->image }}" alt="{{ $menu->nama_menu }}" class="w-8 h-8 rounded-full">
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="{{ route('menu.edit', $menu->id) }}" class="text-purple-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17h2v2h-2zM3 12h18M7 8h2v2H7zM17 16h2v2h-2z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<!-- Custom CSS for white background on search and dropdown -->
<style>
    .dataTables_filter input {
        background-color: white !important;
        color: black !important;
        border: 1px solid #ccc !important;
        padding: 5px;
        border-radius: 4px;
    }

    .dataTables_length select {
        background-color: white !important;
        color: black !important;
        border: 1px solid #ccc !important;
        padding: 5px;
        border-radius: 4px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>
@endsection