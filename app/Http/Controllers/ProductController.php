<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductQuantityRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(ProductCreateRequest $request) {

        DB::beginTransaction();

        try {

            $product = $this->productService->store($request->validated());

            DB::commit();

            return ResponseHelper::success(false, 'produto adicionado com sucesso', $product, 200);

        } catch(\Exception $e) {

            DB::rollBack();

            return ResponseHelper::error(true, $e->getMessage(), null, 400);

        }

    } 

    /**
     * Passo o parâmetro que irá receber pela URL
     */
    public function destroy($id) {

        try {

            $product = $this->productService->destroy($id);

            return ResponseHelper::success(false, 'produto excluido com sucesso', null, 200);

        } catch(\Exception $e) {

            return ResponseHelper::error(true, $e->getMessage(), null, 400);

        }

    }

    public function update(ProductUpdateRequest $request, $id) {

        DB::beginTransaction();

        try {

            $product = $this->productService->update($request->validated(), $id);

            DB::commit();

            return ResponseHelper::success(false, 'produto atualizado com sucesso', $product, 200);

        } catch(\Exception $e) {

            DB::rollBack();

            return ResponseHelper::error(true, $e->getMessage(), null, 400);

        }

    }

    public function index() {

        try {

            $product = $this->productService->index();

            return ResponseHelper::success(false, 'lista de produtos', $product, 200);

        } catch(\Exception $e) {

            return ResponseHelper::error(true, $e->getMessage(), null, 400);

        }
    }

    public function updateQuantity(ProductQuantityRequest $request, $id) {

        DB::beginTransaction();

        try {

            $product = $this->productService->updateQuantity($request->validated(), $id);

            DB::commit();

            return ResponseHelper::success(false, 'quantidade atualizado com sucesso', $product, 200);


        } catch(\Exception  $e) {

            DB::rollBack();

            return ResponseHelper::error(true, $e->getMessage(), null, 400);

        }

    }

}
