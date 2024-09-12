@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Keranjang Belanja Anda</h1>

    @if($cart && count($cart) > 0)
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="w-full table-auto">
            <thead class="bg-gray-100">
                <tr class="text-left border-b border-gray-200">
                    <th class="px-4 py-2">Menu</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Kuantitas</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2">{{ $item['name'] }}</td>
                    <td class="px-4 py-2">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                    <td class="px-4 py-2">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-100">
                <tr>
                    <td colspan="3" class="px-4 py-2 font-semibold text-right">Total</td>
                    <td class="px-4 py-2 font-semibold">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="p-4">
            <form action="{{ route('cart.checkout') }}" method="POST" class="flex flex-col items-end">
                @csrf
                <div class="mb-4">
                    <label for="delivery-date" class="block text-gray-700 font-semibold mb-2">Tanggal Pengiriman:</label>
                    <input type="date" id="delivery-date" name="delivery_date" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm w-full max-w-xs" required>
                </div>
                <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-700">Checkout</button>
            </form>
        </div>
    </div>
    @else
    <p class="text-gray-500">Keranjang belanja Anda kosong.</p>
    @endif
</div>
@endsection