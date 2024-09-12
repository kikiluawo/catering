<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $userId = Auth::id();
        $orders = Order::with('merchant')->where('user_id', $userId)->get();


        return view('invoice.index', compact('orders'));
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
    public function show($id)
    {

        $orders = Order::with('merchant')->where('id', $id)->get(); // Mengambil order berdasarkan ID
        // dd($orders);
        if ($orders->isEmpty()) {
            return redirect()->route('search.index')->with('error', 'Invoice not found.');
        }

        $total = $orders->sum('total');

        return view('invoice', compact('orders', 'total'));
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
