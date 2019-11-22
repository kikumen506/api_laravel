<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//RutAS de prueeba.

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pruebas/{nombre?}', function($nombre = null){
    $texto = '<h2>Texto desde una ruta</h2>';
    $texto .= 'Nombre: '.$nombre;
    return view('pruebas', array(
        'texto' => $texto
    ));
});





Route::get('/animales', 'PruebasController@index');
Route::get('/test-orm', 'PruebasController@testOrm');


// Rutas del API

    //metodos comunes HTTP
    //GET: conseguir datos o recursos
    //POST: Guardar datos o recursos o hacer logica desde un formulario.
    //DELETE: Eliminar datos o recursos.
    //PUT:  Actualizar datos o recursos.

    //Rutas de prueba
    Route::get('/usuario/pruebas', 'userController@pruebas');
    Route::get('/post/pruebas', 'postController@pruebas');
    Route::get('/categoria/pruebas', 'categoryController@pruebas');

    //Rutas del controlador de usuarios.

    Route::post('/api/register', 'userController@register');
    Route::post('/api/login', 'userController@logIn');
    Route::post('/api/user/update', 'userController@update');
