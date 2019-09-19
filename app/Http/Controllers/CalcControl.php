<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcControl extends Controller
{
    public function plus($x, $y)
   {
       $atsak = $x + $y;

       return view('calculator.plus')->with(['calc1'=>$x, 'calc2'=>$y, 'calc3'=>$atsak]);

   }

   public function minus($x, $y)
   {
        $atsak = $x - $y;
       return view('calculator.minus')->with(['calc1' =>$x, 'calc2' =>$y, 'calc3' =>$atsak]);

   }
   public function forma()
   {
       return view('calculator.form');
   }

//    public function plusas($x, $y)
//    {
//     $x = $request->x;
//     $y = $request->y;

//        $atsak = $x + $y;

//        return view('calculator.plus')->with(['calc1'=>$x, 'calc2'=>$y, 'calc3'=>$atsak]);

//    }



   public function sumavimas(Request $request)
   {
       $x = $request->x;
       $y = $request->y;

       $c = $x + $y;
       $request->flash();

       return view('calculator.form')->with(['ats'=>$c]);

    //    return redirect()->back()->with(['ats'=>$c]);
   }

}
