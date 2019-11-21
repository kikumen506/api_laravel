<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function pruebas(Request $request){
        return "Accion de prueba de usrController";
    }

    public function register(Request $request){

        //Recoger los datos del usuario por POST
        $json = $request->input('json', null);
        $params = json_decode($json);  //saca objeto
        $params_array = json_decode($json, true);  //saca un array

        var_dump($params_array);

        die();

        //Validar datos



        //Cifrar la contraseña



        //Comprobar usuario(duplicado)



        //Crear al usuario


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
