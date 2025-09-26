<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function register(Request $request) {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'quantity' => ['required', 'integer']
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity']
        ]);

        return response()->json(['produto cadastrado' => true, 'product' => $product]);
            // $table->id();
            // $table->string('name');
            // $table->decimal('price', total:8, places:2);
            // $table->bigInteger('quantity');
    } 
}
