<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('user.catalog', compact('products'));
    }
}
