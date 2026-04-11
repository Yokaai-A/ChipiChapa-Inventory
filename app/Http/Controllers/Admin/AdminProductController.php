<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_barang' => 'required|string|min:5|max:80',
            'harga_barang' => 'required|integer',
            'jumlah_barang' => 'required|integer',
            'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $path = $request->file('foto_barang')?->store('products', 'public');

        Product::create([
            'category_id' => $request->category_id,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'foto_barang' => $path
        ]);

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_barang' => 'required|string|min:5|max:80',
            'harga_barang' => 'required|integer',
            'jumlah_barang' => 'required|integer',
            'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('foto_barang')) {
            $path = $request->file('foto_barang')->store('products', 'public');
            $product->foto_barang = $path;
        }

        $product->update([
            'category_id' => $request->category_id,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        if ($request->hasFile('foto_barang')) {
            $product->save(); // Save the photo
        }

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
