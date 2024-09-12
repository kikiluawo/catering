<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowCustomerOrderController extends Controller
{

    public function showCustomerOrders()
    {
        $customerId = Auth::user()->id;

        // Ambil semua order customer dan group by tanggal pengiriman
        $ordersGroupedByDate = Order::where('user_id', $customerId)
            ->orderBy('delivery_date')
            ->get()
            ->groupBy(function ($order) {
                return $order->delivery_date;
            });

        return view('customer.orders.index', compact('ordersGroupedByDate'));
    }

    public function showCustomerInvoice($date)
    {
        // dd($date);
        $customerId = Auth::user()->id;

        // Ambil pesanan customer untuk tanggal pengiriman tertentu
        $orders = Order::where('user_id', $customerId)
            ->whereDate('delivery_date', $date)
            ->get();

        return view('customer.orders.show', [
            'orders' => $orders,
            'date' => $date
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
