<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaraController extends Controller
{
   public function lara($param, $param2 ='')
   {
       return view('lara.lara')->with(['larosP1' => $param]);

   }

}
