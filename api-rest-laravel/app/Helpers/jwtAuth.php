<?php 
namespace App\Helpers;


use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;

class jwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'key_para_token_crypt0_2o19';
    }

    public function signUp($email, $password){
        // Buscar al usuario con sus credenciales
        $user = User::where([
            'email' => $email,
            'password' =>$password
        ])->first();

        //Comprobar si las credenciales son correctas
        $signUp = false;
        if(\is_object($user)){
            $signUp = true;
        }

        //Generar el token con los datos del usuario
        if($signUp){

            $token = array(
                'sub'  => $user->id,
                'email'  => $user->email,
                'name'  => $user->name,
                'surname'  => $user->surname,
                'iat'  => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
        } else {
            $data = array(
                'status' => 'error'
            );
        }

        //Devolver los datos codificados o el token en funcion de un parametro


        return 'Metodo de la clase JWTAUTH. ';
    }

}







?>