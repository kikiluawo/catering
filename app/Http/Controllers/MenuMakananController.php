<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;



class MenuMakananController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::where('user_id', Auth::user()->id)->get();
        // dd($menus);
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        return view('menu.create'); // Menampilkan halaman form create
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => '',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Buat nama gambar unik
            $imageName = time() . '.' . $request->file('image')->extension();

            // Pindahkan gambar ke folder 'public/images'
            $request->file('image')->move(public_path('images'), $imageName);

            // Set path gambar
            $imagePath = '/images/' . $imageName;
        }

        // Simpan data menu makanan ke database
        Menu::create([
            'user_id'   => Auth::user()->id,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu makanan berhasil ditambahkan');
    }

    public function edit($id)
    {

        // Temukan menu berdasarkan ID
        $menu = menu::findOrFail($id);

        // Return view edit dengan data menu yang ditemukan
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the user's profile information.
     */

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Temukan menu berdasarkan ID
        $menu = Menu::findOrFail($id);

        // Update data menu
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');

        // Jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }

            // Buat nama gambar unik
            $imageName = time() . '.' . $request->file('image')->extension();

            // Simpan gambar ke folder 'public/images'
            $imagePath = 'images/' . $imageName;
            $request->file('image')->move(public_path('images'), $imageName);

            // Update path gambar
            $menu->image = '/' . $imagePath;
        }
        // Simpan perubahan
        $menu->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('menu.index')->with('success', 'Menu updated successfully');
    }


    /**
     * Delete the user's account.
     */
    public function destroy($id)
    {
        // Temukan menu berdasarkan ID
        $menu = Menu::findOrFail($id);

        // Hapus gambar dari folder 'public/images' jika ada
        if ($menu->image && file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }

        // Hapus data menu dari database
        $menu->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully');
    }
}
