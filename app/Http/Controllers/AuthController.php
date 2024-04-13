<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->all('email', 'password');
        $token = auth('api')->attempt($credentials);

        if ($token) {
            return response()->json(['token' => $token, 200]);
        } else {
            return response()->json(['error' => 'Usuário ou senha invalidos', 403]);
        }
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Deslogado'], 200);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function me()
    {
       return response()->json(auth()->user());
    }
}
