<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchantId = Auth::user()->id; // Ambil ID merchant yang sedang login
        $orders = Order::where('merchant_id', $merchantId)
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal pesanan
            ->get();

        // Kelompokkan pesanan berdasarkan tanggal pengiriman
        $groupedOrders = $orders->groupBy('delivery_date');
        return view('merchant.orders.index', compact('groupedOrders'));
    }

    public function showInvoiceByDate($date)
    {
        $merchantId = Auth::user()->id;

        $orders = Order::where('merchant_id', $merchantId)
            ->whereDate('delivery_date', $date)
            ->get();

        return view('merchant.orders.show', compact('orders', 'date'));
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
