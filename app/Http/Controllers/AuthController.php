<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index(RegisterUserRequest $request) {
        
        DB::transaction();

        try{

            $user = $this->authService->register($request->validated());

            return response()->json(['error' => false, 'user' => $user]);
            
            DB::commit();

        }catch(\Exception $e){

            DB::rollBack();
            throw($e);

        }

    }

    public function login(Request $request) {

        $validated = $request->validate([
            'email' => ['required','string', 'max:100'],
            'password' => ['required', 'string', 'min:6']
        ]); 

        if(Auth::attempt($validated)) {

            $user = User::where('email', $validated['email'])->first();

            $token = $user->createToken('token-api');
            return response()->json(['user' => $user, 'loggado' => true, 'token' => $token]);

        }

        return response()->json(['loggado' => false, 'mensagem' => 'credenciais inválidas']);

    }

   

}
