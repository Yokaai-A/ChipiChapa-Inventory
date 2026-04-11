<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->jumlah_barang == 0 || $product->jumlah_barang < $request->qty) {
            return redirect()->back()->with('error', 'Barang sudah habis, silakan tunggu hingga barang di-restock ulang');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $request->qty;
        } else {
            $cart[$product->id] = [
                'name' => $product->nama_barang,
                'price' => $product->harga_barang,
                'qty' => $request->qty
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('catalog')->with('success', 'Barang berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart');
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        return redirect()->route('checkout')->with('success', 'Keranjang diperbarui');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $cart = session()->get('cart');
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('checkout')->with('success', 'Barang dihapus dari keranjang');
    }
}
