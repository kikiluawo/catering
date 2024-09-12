@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Orders</h1>

    @foreach($ordersGroupedByDate as $date => $orders)
    <div class="mb-6 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-4 bg-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-semibold">Tanggal Pengiriman: {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h2>

        </div>

        <table class="w-full table-auto">
            <thead class="bg-gray-100">
                <tr class="text-left border-b border-gray-200">
                    <th class="px-4 py-2">Order ID</th>
                    <th class="px-4 py-2">Nama Merchant</th>
                    <th class="px-4 py-2">Menu</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2">{{ $order->id }}</td>
                    <td class="px-4 py-2">{{ $order->merchant->name }}</td>
                    <td class="px-4 py-2">{{ $order->menu_description }}</td>
                    <td class="px-4 py-2">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <a href="{{ route('customer.invoice.show', ['date' => $date]) }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-700">Lihat Invoice</a>
        </div>
    </div>
    @endforeach

    @empty($groupedOrders)
    <p class="text-gray-500 mt-4">No orders found.</p>
    @endempty
</div>
@endsection