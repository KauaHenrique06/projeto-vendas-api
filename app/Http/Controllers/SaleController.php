<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{

    protected SaleService $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function store(StoreSaleRequest $request) {
        
        DB::beginTransaction();
        try{

            $sale = $this->saleService->store($request->validated());
            DB::commit();

            return ResponseHelper::success(false, "Venda Cadastrada com sucesso", $sale, 201);
        }catch(\Exception $e){
            DB::rollBack();
            return ResponseHelper::error(true, $e->getMessage(), null, 400);
        }

    }

    public function show($id){
        try{
            $sale = $this->saleService->show($id);
            return ResponseHelper::success(false, "Venda Buscada com sucesso", $sale, 200);
        }catch(\Exception $e){
            return ResponseHelper::error(true, $e->getMessage(), null, 400);
        }
    }

    public function index(){
        return ResponseHelper::success(false, "Lista de vendas buscada", $this->saleService->index(), 200);
    }

    public function destroy($id){
        DB::beginTransaction();
        try{

            $sale = $this->saleService->destroy($id);
            DB::commit();

            return ResponseHelper::success(false, "Venda cancelada com sucesso", null, 200);
        }catch(\Exception $e){
            DB::rollBack();
            return ResponseHelper::error(true, $e->getMessage(), null, 400);
        }
    }
}
