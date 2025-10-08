<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Exception;

class AuthController extends Controller
{

    /**
     * Declaro a variavel para armazenar a instancia da classe AuthService
     */
    protected AuthService $authService;

    /**
     * Passo os valores que ele irá receber,
     * diz que a instancia da classe deve ser passada quando a classe for criada
     */
    public function __construct(AuthService $authService)
    {
        /**
         * Quer dizer que a variavel da minha classe authService 
         * vai guardar o objeto recebido no construtor.
         * 
         * O this serve para indicar a classe atual
         */
        $this->authService = $authService;
    }

    public function index(RegisterUserRequest $request) {
        
        DB::beginTransaction();

        try{

            $user = $this->authService->register($request->validated());

            DB::commit();

            return ResponseHelper::success(false, 'usuário criado com sucesso', $user, 200);

        }catch(Exception $e){

            DB::rollBack();

            return ResponseHelper::error(true, $e->getMessage(), null, 400);

        }

    }

    public function login(LoginUserRequest $request) {

        try{

            $user = $this->authService->login($request->validated());

            $token = $user->createToken('token-acesso')->plainTextToken;

            return ResponseHelper::success(false, 'usuário logado com sucesso', $token, 200);
 
        } catch(\Exception $e) {

            return ResponseHelper::error(true, $e->getMessage(), null, 400);
        }
    
    }
   
}
