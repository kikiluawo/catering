<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request, $menuId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += $request->input('quantity');
        } else {
            $menu = Menu::find($menuId);
            $cart[$menuId] = [
                'name' => $menu->description,
                'price' => $menu->price,
                'quantity' => $request->input('quantity')
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item added to cart');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('cart.index', compact('cart', 'total'));
    }

    public function checkout(Request $request)
    {

        $cart = session('cart');

        if (!$cart) {
            return redirect()->route('search.index')->with('error', 'Cart is empty.');
        }

        $userId = Auth::user()->id;
        $orderIds = [];
        $deliveryDate = $request->input('delivery_date'); // Ambil tanggal pengiriman dari request
        // dd($deliveryDate);
        foreach ($cart as $id => $item) {
            // Ambil menu terkait untuk mendapatkan merchant_id
            $menu = Menu::find($id);

            // Cek apakah menu ada
            if (!$menu) {
                continue; // Jika menu tidak ada, lanjutkan ke item berikutnya
            }

            $order = Order::create([
                'user_id' => $userId,
                'menu_description' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
                'merchant_id' => $menu->user_id, // Menyimpan merchant_id dari menu
                'delivery_date' => $deliveryDate, // Menyimpan tanggal pengiriman
            ]);
            $orderIds[] = $order->id;
        }

        session()->forget('cart');

        return redirect()->route('invoice.show', ['id' => $orderIds[0]])->with('success', 'Order placed successfully');
    }
}

/**
 * Display a listing of the resource.
 */
