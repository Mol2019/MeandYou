<?php

namespace App\Http\Controllers\t2or;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pack;
use App\Models\Don;
use Illuminate\Support\Facades\Validator;


class PacksController extends Controller
{
    //
    public function index()
    {
      $data = Pack::all();
      return view('app.administration.packs')->with("data",$data);
    }

    public function create(Request $request)
    {
      $rules = [
        "titre" => "required",
        "montant" => "required|numeric",
      ];

      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
          return response()->json(['errors' => $error->errors()->all()]);
      }
      Pack::create( $request->all());
      return response()->json(["success" => "Pack ajouté avec succès"]);
    }

    public function update(Request $request)
    {
      $rules = [
        "titre" => "required",
        "montant" => "required|numeric",
      ];

      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
          return response()->json(['errors' => $error->errors()->all()]);
      }

      $pack = Pack::findOrFail($request->hidden_id);

      $pack->update( $request->all());

      return response()->json(["success" => "Pack mis à jour avec succès"]);
    }

    public function edit($id)
    {
      return response()->json(["data" => Pack::findOrfail($id)]);
    }

    public function delete($id)
    {
        $pack = Pack::findOrFail($id);
        $test = Don::wherePack($id)->get();
        if($test->count() > 0 ):
          $pack->withTrashed()->whereId($id)->get();
        else:
          $pack->forceDelete();
        endif;
        return response()->json(["success" => "Pack mis à jour avec succès"]);
    }
}
