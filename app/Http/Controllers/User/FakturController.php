<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Faktur;
use App\Models\DetailFaktur;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FakturController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);
        $total_harga = 0;

        foreach ($cart as $item) {
            $total_harga += $item['price'] * $item['qty'];
        }

        return view('user.checkout', compact('cart', 'total_harga'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string|min:10|max:100',
            'kode_pos' => 'required|digits:5'
        ]);

        $cart = session('cart');
        if (!$cart) {
            return redirect()->route('catalog')->with('error', 'Keranjang kosong');
        }

        DB::beginTransaction();
        try {
            $total_harga = 0;
            foreach ($cart as $item) {
                $total_harga += $item['price'] * $item['qty'];
            }

            $lastFaktur = Faktur::latest('id')->first();
            $nextId = $lastFaktur ? $lastFaktur->id + 1 : 1;
            $nomor_invoice = 'INV-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $faktur = Faktur::create([
                'user_id' => auth()->id(),
                'nomor_invoice' => $nomor_invoice,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'kode_pos' => $request->kode_pos,
                'total_harga' => $total_harga
            ]);

            foreach ($cart as $id => $item) {
                $subtotal = $item['price'] * $item['qty'];
                
                DetailFaktur::create([
                    'faktur_id' => $faktur->id,
                    'product_id' => $id,
                    'kuantitas' => $item['qty'],
                    'subtotal' => $subtotal
                ]);

                // Update stock
                $product = Product::find($id);
                if ($product) {
                    $product->jumlah_barang -= $item['qty'];
                    $product->save();
                }
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('invoice.print', $faktur->id)->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout')->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    public function print($id)
    {
        $faktur = Faktur::with(['detailFakturs.product', 'user'])->findOrFail($id);

        if ($faktur->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('user.invoice_print', compact('faktur'));
    }
}
