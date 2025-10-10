<?php

namespace App\Services;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProductService {

    public function store(Array $productData) {

        $logged_user = Auth::user();

        if($logged_user->user_type_id != 1){
            throw new \Exception("Apenas vendedores podem criar produtos");
        }

        $product = Product::create([
            'name' => $productData['name'],
            'price' => $productData['price'],
            'quantity' => $productData['quantity']
        ]);

        return $product;

    }

    public function destroy($id) {

        $logged_user = Auth::user();

        if($logged_user->user_type_id != 1){
            throw new \Exception("Apenas vendedores podem remover produtos");
        }

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
        $logged_user = Auth::user();

        if($logged_user->user_type_id != 1){
            throw new \Exception("Apenas vendedores podem atualizar produtos");
        }

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

    public function index() {

        $product = Product::all();

        return $product;

    }

}