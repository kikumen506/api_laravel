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

    public function signUp($email, $password, $getToken = null){
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
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);

            //Devolver los datos codificados o el token en funcion de un parametro
            if (is_null($getToken)) {
                $data = $jwt;
            } else {
                $data = $decoded;
            }

        } else {

            $data = array(
                'status' => 'error',
                'message' => 'LogIn incorrecto'
            );

        }

        


        return $data;
    }

    public function checkToken($jwt, $getIdentity = false){
        $auth = false; 

        try {
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        } catch (\UnexpectedValueException $e) {
            $auth = false;
        } catch (\DomainException $e){
            $auth = false;
        }


        if (!empty($decoded) && is_object($decoded) && isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }


        if ($getIdentity) {
            return $decoded;
        }
        return $auth;
    }

}







?>