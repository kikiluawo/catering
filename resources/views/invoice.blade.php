@extends('admin.layouts.app')
@section('contents')
<div style="max-width: 800px; margin: 0 auto; padding: 1rem; background-color: #f3f4f6;">
    <h1 style="font-size: 2rem; font-weight: bold; color: #1f2937; margin-bottom: 1.5rem;">Invoice</h1>

    @if($orders->isNotEmpty())
    <div style="background-color: #ffffff; box-shadow: 0 1px 2px rgba(0,0,0,0.1); border-radius: 0.5rem; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #e5e7eb; color: #4b5563; text-transform: uppercase; font-size: 0.875rem;">
                    <th style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">Menu</th>
                    <th style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">Price</th>
                    <th style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">Quantity</th>
                    <th style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">Total</th>
                    <th style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">Merchant</th>
                </tr>
            </thead>
            <tbody style="color: #374151;">
                @foreach($orders as $order)
                <tr>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">{{ $order->menu_description }}</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">Rp{{ number_format($order->price, 2) }}</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">{{ $order->quantity }}</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">Rp{{ number_format($order->total, 2) }}</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #d1d5db;">{{ $order->merchant->name ?? 'Unknown' }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="background-color: #e5e7eb; color: #4b5563; font-size: 0.875rem;">
                <tr>
                    <td colspan="4" style="padding: 0.75rem; border-bottom: 1px solid #d1d5db; text-align: right; font-weight: bold;">Grand Total</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #d1d5db; font-weight: bold;">Rp{{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <p style="color: #6b7280; margin-top: 1rem;">No orders found.</p>
    @endif
</div>
@endsections