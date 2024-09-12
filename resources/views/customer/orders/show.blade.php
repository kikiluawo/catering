@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Invoice untuk {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h1>

    @if($orders->isNotEmpty())
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <th class="px-6 py-4 border-b">Order ID</th>
                    <th class="px-6 py-4 border-b">Menu</th>
                    <th class="px-6 py-4 border-b">Price</th>
                    <th class="px-6 py-4 border-b">Quantity</th>
                    <th class="px-6 py-4 border-b">Total</th>
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
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-200 text-gray-700 text-sm">
                <tr>
                    <td colspan="4" class="px-6 py-4 border-b text-right font-semibold">Grand Total</td>
                    <td class="px-6 py-4 border-b font-semibold">Rp{{ number_format($orders->sum('total'), 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <p class="text-gray-500 mt-4">Tidak ada pesanan untuk tanggal ini.</p>
    @endif
</div>
@endsection