<?php

namespace App\Services;
use App\Models\Product;
use Exception;

class ProductService {

    public function index(Array $productData) {

        $product = Product::create([
            'name' => $productData['name'],
            'price' => $productData['price'],
            'quantity' => $productData['quantity']
        ]);

        return $product;

    }

    public function delete($id) {

        /**
         * Procuro o item com o id passado na requisição
         */
        $product = Product::find($id);

        /**
         * Verifico se existe produto com esse id,
         * caso não eu retorno o erro e não apago do banco
         */
        if(!$product) {

            throw new Exception('produto não cadastrado');
            
        }

        return $product->delete();

    }

    public function update(Array $productData, $id) {

        $product = Product::find($id);

        if(!$product) {

            throw new Exception('produto não cadastrado');
            
        }

        /**
         * Chamo o método de atualizar e passo
         * os dados que vão ser atualizados
         */
        $product->update($productData);

        return $product;

    }

}