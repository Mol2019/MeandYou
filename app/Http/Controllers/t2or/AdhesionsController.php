<?php

namespace App\Http\Controllers\t2or;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adhesion;
use Auth;

class AdhesionsController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Adhesion Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the users adhesions.
  |
  */

  //Get all adhesions
  public function index()
  {
    /*if(Auth::user()->role == "admin" ):
        $data = Adhesion::all();
        return view('app.administration.adhesion');
    endif;*/
    $data = Adhesion::all();
    return view('app.administration.adhesion')->with("data",$data);
      //$data =
  }
}
