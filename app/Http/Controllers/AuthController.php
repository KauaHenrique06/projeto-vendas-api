<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request) {
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required','string', 'max:100'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        DB::beginTransaction();
        try{
            
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            $token = $user->createToken('token-api');
            return response()->json(['user' => $user, 'registrado' => true, 'token' => $token->plainTextToken]);
            
            DB::commit();

        }catch(\Exception $e){

            DB::rollBack();
            throw($e);

        }

    }

    public function login(Request $request) {

    }
}
