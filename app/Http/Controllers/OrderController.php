<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = $this->orderService->createOrder($data);
            return ResponseHelper::success(false, 'Pedido criado, aguarde a resposta da loja', $order, 200);
        } catch (\Exception $e) {
            return ResponseHelper::error(true, $e->getMessage(), null, 400);
        }
    }

    public function index(){

    }

    public function accept($id)
    {
        try {
            $order = $this->orderService->acceptOrder($id);
            return ResponseHelper::success(false, 'Pedido aceito!', null, 200);
        } catch (\Exception $e) {
            return ResponseHelper::error(true, $e->getMessage(), null, 400);
        }
    }

    public function deny($id)
    {
        try {
            $order = $this->orderService->denyOrder($id);
            return ResponseHelper::success(false, 'Pedido rejeitado!', null, 200);
        } catch (\Exception $e) {
            return ResponseHelper::error(true, $e->getMessage(), null, 400);
        }
    }

}