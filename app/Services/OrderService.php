<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth as SupportFacadesAuth;
use Illuminate\Support\Facades\DB;
use stdClass;

class OrderService
{
    public function createOrder(array $data): Order
    {
        $logged_user = FacadesAuth::user();

        if($logged_user->user_type_id != 2){
            throw new \Exception("Apenas clientes podem criar pedidos");
        }

        $product = Product::findOrFail($data['product_id']);

        if ($data['quantity'] > $product->quantity) {
            throw new \Exception('Estoque insuficiente para a quantidade solicitada.');
        }

        return Order::create([
            'user_id' => $logged_user->id,
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'status' => OrderStatus::PENDING,
        ]);
    }

    public function acceptOrder($id): Order
    {
        $logged_user = FacadesAuth::user();

        if($logged_user->user_type_id != 1){
            throw new \Exception("Apenas vendedores podem aceitar pedidos");
        }

        $order = Order::find($id);

        if(!$order){
            throw new \Exception("Esse pedido não existe!");
        }

        if ($order->status !== OrderStatus::PENDING) {
            throw new \Exception('Este pedido não pode mais ser aceito.');
        }

        return DB::transaction(function () use ($order) {
            $product = Product::lockForUpdate()->findOrFail($order->product_id);

            if ($order->quantity > $product->quantity) {
                throw new \Exception('Estoque se tornou insuficiente. Não é possível aceitar o pedido.');
            }

            Sale::create([
                'user_id' => $order->user_id,
                'product_id' => $order->product_id,
                'quantity' => $order->quantity,
                'unit_price' => $product->price,
            ]);

            $product->quantity -= $order->quantity;
            $product->save();

            $order->status = OrderStatus::FULFILLED;
            $order->save();
            
            return $order;
        });
    }

    public function denyOrder($id): Order
    {
        $logged_user = FacadesAuth::user();

        if($logged_user->user_type_id != 1){
            throw new \Exception("Apenas vendedores podem negar pedidos");
        }

        $order = Order::find($id);

        if(!$order){
            throw new \Exception("Esse pedido não existe!");
        }

        if ($order->status !== OrderStatus::PENDING) {
            throw new \Exception('Este pedido não pode mais ser cancelado.');
        }

        $order->status = OrderStatus::CANCELED;
        $order->save();

        return $order;
    }

    public function index(){
        $auth_user = SupportFacadesAuth::user();

        $order_list = [];

        if($auth_user->user_type_id == 2){
            $order_list = Order::where('user_id', $auth_user->id)->get();
        }else{
            $order_list = Order::all();
        }

        foreach($order_list as $order){
            $formatted_order = $this->formatOrder($order);

            array_push($order_list, $formatted_order);
        }

        return $order_list;
    }

    // UTILS
    public function formatOrder($order){
        $formattedOrder = new stdClass();

        $formattedOrder->id = $order->id;
        $formattedOrder->product_id = $order->product_id;
        $formattedOrder->product_name = $order->product->name;
        $formattedOrder->user_id = $order->user_id;
        $formattedOrder->user_name = $order->user->name;
        $formattedOrder->status = $order->status;

        return $formattedOrder;
    }
}