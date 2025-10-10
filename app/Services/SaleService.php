<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use stdClass;

class SaleService
{ 
    public function store(Array $saleData)
    {

        $quantity = empty($saleData['quantity']) ? 1 : $saleData['quantity'];

        $product = Product::find($saleData['product_id']);

        if($quantity > $product->quantity){
            throw new \Exception("You cannot sell more products than you have!");
        }

        $sale = Sale::create([
            'user_id'    => $saleData['user_id'],
            'product_id' => $saleData['product_id'],
            'quantity'   => $quantity,
            'unit_price' => $product->price
        ]);

        $product->quantity = $product->quantity - $quantity; 

        $product->save();

        return $sale;
    }

    public function show($id){
        $sale = Sale::with(['user', 'product'])->find($id);

        $formattedSale = $this->formatSale($sale);

        return $formattedSale;
    }

    public function index(){
        $auth_user = FacadesAuth::user();

        $sales = [];

        $formattedSales = [];

        if($auth_user->user_type_id == 2){
            $sales = Sale::where('user_id', $auth_user->id)->get();
        }else{
            $sales = Sale::all();
        }

        foreach($sales as $sale){
            $formatted = $this->formatSale($sale);

            array_push($formattedSales, $formatted);
        }

        return $formattedSales;
    }

    public function destroy($id){
        $sale = Sale::find($id);

        if(!$sale){
            throw new \Exception("Non Existent Sale!");
        }

        $product = Product::where('id', $sale->product_id)->firstOrFail();

        $product->quantity = $product->quantity + $sale->quantity;

        $product->save();

        return $sale->delete();
    }

    // UTILS
    public function formatSale($sale): stdClass
    {
        $formattedSale = new stdClass();

        $formattedSale->id = $sale->id;
        $formattedSale->product_id = $sale->product_id;
        $formattedSale->product_name = $sale->product->name;
        $formattedSale->user_id = $sale->user_id;
        $formattedSale->user_name = $sale->user->name;
        $formattedSale->quantity = $sale->quantity;
        $formattedSale->total_price = $sale->quantity * $sale->unit_price;

        return $formattedSale;
    }
}