@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Orders</h1>

    @foreach($groupedOrders as $deliveryDate => $orders)
    <div class="mb-6 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-4 bg-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-semibold">Tanggal Pengiriman: {{ \Carbon\Carbon::parse($deliveryDate)->format('d-m-Y') }}</h2>
            <a href="{{ route('merchant.show', ['date' => $deliveryDate]) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-700">View Invoice</a>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <th class="px-6 py-4 border-b">Order ID</th>
                    <th class="px-6 py-4 border-b">Menu</th>
                    <th class="px-6 py-4 border-b">Price</th>
                    <th class="px-6 py-4 border-b">Quantity</th>
                    <th class="px-6 py-4 border-b">Total</th>
                    <th class="px-6 py-4 border-b">Customer</th>
                    <th class="px-6 py-4 border-b">Date</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($orders as $order)
                <tr>
                    <td class="px-6 py-4 border-b">{{ $order->id }}</td>
                    <td class="px-6 py-4 border-b">{{ $order->menu_description }}</td>
                    <td class="px-6 py-4 border-b">Rp{{ number_format($order->price, 2) }}</td>
                    <td class="px-6 py-4 border-b">{{ $order->quantity }}</td>
                    <td class="px-6 py-4 border-b">Rp{{ number_format($order->total, 2) }}</td>
                    <td class="px-6 py-4 border-b">{{ $order->user->name ?? 'Unknown' }}</td>
                    <td class="px-6 py-4 border-b">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach

    @empty($groupedOrders)
    <p class="text-gray-500 mt-4">No orders found.</p>
    @endempty
</div>
@endsection