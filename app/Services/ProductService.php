<?php

namespace App\Services;
use App\Models\Product;

class ProductService {

    public function index(Array $productData) {

        $product = Product::create([
            'name' => $productData['name'],
            'price' => $productData['price'],
            'quantity' => $productData['quantity']
        ]);

        return $product;

    }

}