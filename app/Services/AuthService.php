<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService {

    public function register(Array $userData) {

        $user = User::create([

            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],

        ]);

        return $user;

    }

    public function login(Array $userData) {

        if(Auth::attempt($userData)) {
            
            return $user = User::where('email', $userData['email'])->first();

        }

        throw new \Exception('Credenciais inválidas');
        
    }

} 