<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class postController extends Controller
{
    public function pruebas(Request $request){
        return "Test de postController";
    }
}
