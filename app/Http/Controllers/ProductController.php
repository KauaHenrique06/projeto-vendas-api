<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function register(ProductCreateRequest $request) {

        DB::beginTransaction();

        try {

            $product = $this->productService->index($request->validated());

            DB::commit();

            return ResponseHelper::success(false, 'produto adicionado com sucesso', $product, 200);

        } catch(\Exception $e) {

            DB::rollBack();

            return ResponseHelper::error(true, $e->getMessage(), null, 400);

        }

    } 
}
