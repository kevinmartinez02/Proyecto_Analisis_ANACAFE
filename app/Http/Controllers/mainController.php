<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mainController extends Controller
{
    //
    public function __invoke(){
        return view('main');
    }
}
