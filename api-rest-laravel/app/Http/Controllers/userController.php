<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function pruebas(Request $request){
        return "Accion de prueba de usrController";
    }

    public function register(Request $request){
        $data = array(
            'status' => 'error',
            'code' => 404,
            'message' => 'El usuario no se ha creado.'
        );

        return response()->json($data, $data['code']);
    }

    public function logIn(Request $request){
        return "Accion de logIn de usuario";
    }
}
