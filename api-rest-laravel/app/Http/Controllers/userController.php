<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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



        if(!empty($params) && !empty($params_array)){

            //Limpiar datos
            $params_array = array_map('trim', $params_array);


            //Validar datos
            $validate = \Validator::make($params_array,[
            'name' => 'required | alpha',
            'surname' => 'required | alpha',
            'email' => 'required | email | unique:users', //Comprobar usuario(duplicado) gracias a la regla de validacion |unique
            'password' => 'required'
            ]); 

            if($validate->fails()){
                //FALLO EN VALIDACION
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no se ha creado.',
                    'errors' => $validate->errors()
                );    
            } else {

                //VALIDACION CORRECTA
                //Cifrar la contraseña
                $pwd = password_hash($params->password, PASSWORD_BCRYPT, ['cost' => 4]);


                //Crear al usuario

                $user = new User();
                $user ->name = $params_array['name'];
                $user ->surname = $params_array['surname'];
                $user ->email = $params_array['email'];
                $user ->password = $pwd;
                $user ->role = 'ROLE_USER';

                //Guardar usuario
                $user ->save();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Usuario creado correctamente'
                );
            }
        } else {
            
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos.',
            );
        }

        return response()->json($data, $data['code']);
    }

    public function logIn(Request $request){
        return "Accion de logIn de usuario";
    }
}
