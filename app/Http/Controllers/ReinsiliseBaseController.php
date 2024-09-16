<?php

namespace App\Http\Controllers;

use App\Models\ReinsialiseBase;
use Illuminate\Http\Request;

class ReinsiliseBaseController extends Controller
{

public function index(){
    return view('reinsitilisation');
}

   public function reset_database(){
    $reset=new ReinsialiseBase();
    $re=$reset->resetBase();
      
    return redirect()->intended('/home');
   }
}