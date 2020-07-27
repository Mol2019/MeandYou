<?php

namespace App\Http\Controllers\t2or;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Log;
use App\Models\Residence;
use App\Models\Don;

class UsersController extends Controller
{
    // begin admin
    public function adminspace()
    {
      $data = User::whereRole("admin")->get();
      foreach ($data as $admin) {
        $admin->residence = Residence::findOrFail($admin->residence);
      }
      return view("app.backoffice.users.admins")->with('data',$data);
    }

    public function masterspace()
    {
      $data = User::whereRole("master")->get();
      foreach ($data as $master) {
        $master->residence = Residence::findOrFail($master->residence);
      }
      return view("app.backoffice.users.masters")->with('data',$data);
    }

    /**
     * Create a new admin user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function addAdmin(Request $request)
    {
      $rules = [
        "nom" => "required",
        "prenoms" => "required",
        "email" => "required|email|unique:users",
        "contact1" => "required|numeric",
        "password" => "required"
      ];

      $error = Validator::make($request->all(), $rules);

     if($error->fails())
     {
         return response()->json(['errors' => $error->errors()->all()]);
     }


      if(Auth::user()->role == "st2or"):
        $data = [
          'nom' => $request->nom,
          "prenoms" => $request->prenoms,
          "is_locked" => false ,
          "lien_parainage" => "nothing" ,
          "photo" => NULL,
          "residence" => "1",
          'email' => $request->email,
          "date2naissance" => "2020-07-21",
          'password' => Hash::make($request->password),
          "contact1" => "".$request->contact1,
          "contact2" => $request->contact1,
          "perfect_money" => $request->contact1,
          'role' => "admin"
        ];
        User::create($data);
        return back()->with("success","Administrateur enregistré avec succès");
      else :
        return back()->with("error","Vous n'êtes pas autorisé à exécutez une telle action");
      endif;
    }

    //bloquer ou debloquer Utilisateur
    public function lockOrUnlockUser($id)
    {
      $user = User::findOrFail($id);
      $status = "";
      if($user->is_locked) :
        $user->is_locked = false;
        $status = "bloqué";
      else :
        $user->is_locked = true;
        $status = "débloqué";
      endif;
      $user->save();
      return back()->with("success","Utilisateur ".$user->email.' '.$status. " avec succès");
    }

    public function deleteAdmin($id)
    {
       $test = Log::whereUser($id)->get();
       $user = User::findOrFail($id);

       if($test->count() > 0):
         $user->withTrashed()->whereId($id)->get();
      else:
         $user->forceDelete();
      endif;
      return back()->with("success","Administrateur supprimé avec succès");
    }
    //End of admin management

    //master management
    public function addMaster(Request $request)
    {
      $rules = [
        "nom" => "required",
        "prenoms" => "required",
        "email" => "required|email|unique:users",
        "contact1" => "required|numeric",
        "password" => "required"
      ];

      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
          return response()->json(['errors' => $error->errors()->all()]);
      }
      $count = User::whereRole('master')->get()->count();
      if($count <= 10) :
        $user = User::whereEmail($request->email)->get();
        if($user->count() > 0) :
          $data = User::findOrFail($user[0]->id);
          $data->role = "master";
          $data->lien_parainage = self::master_link();
          $data->save();
        else :
          $data = [
            'nom' => $request->nom,
            "prenoms" => $request->prenoms,
            "is_locked" => false ,
            "lien_parainage" => self::master_link(),
            "photo" => NULL,
            "residence" => "1",
            'email' => $request->email,
            "date2naissance" => "2020-07-21",
            'password' => Hash::make($request->password),
            "contact1" => $request->contact1,
            "contact2" => $request->contact1,
            "perfect_money" => $request->contact1,
            'role' => "master"
          ];
          User::create($data);
        endif;
        Log::create([
          "user" => Auth::user()->id,
          "action" => "Création d'un nouveau master"
        ]);
        return response()->json(["success" => "Master ajouté avec succès"]);
      else :
        return response()->json(["error" => "Nombre maximale de master atteint"]);
      endif;
    }

    public function deleteMaster($id)
    {
      $user = User::findOrFail($id);

      $dons = $user->dons()->count();
      $rsds = $user->rsds()->count();
      $gains = $user->gains()->count();
      $adhesions = $user->adhesion()->count();

      if($dons > 0 || $rsds > 0 || $gains > 0 || $adhesions > 0):
        $user->withTrashed()->whereId($id)->get();
     else:
        $user->forceDelete();
     endif;
    }

    private function master_link()
    {
      $string = "";
      $user_ramdom_key = "(aLABbC0cEd1[eDf2FghR3ij4kYXQl5Um-OPn6pVq7rJs8*tuW9I+vGw@xHTy&#)K]Z%§!M_S";
      srand((double)microtime()*time());
      for($i=0; $i<20; $i++) {
        $string .= $user_ramdom_key[rand()%strlen($user_ramdom_key)];
      }
      if(User::whereLienParainage($string)->get()->count() > 0) :
        $string = self::master_link();
      endif;
      return $string;
    }

    public function filleulesList($link)
    {
      $data = User::whereLienParainageAndRole($link,"suse")->get();
      $data->parain_id = User::whereLienParainageAndRole($link,"master")->first()->id;
      return view("app.backoffice.users.filleules")->with('data',$data);
    }

    public function parrainspace()
    {
      $data = User::whereLienParainageAndRole(Auth::user()->lien_parainage,"suse")->get();
      $data->bonus = Auth::user()->gains;
      foreach ($data->bonus as $bonus) {
         $bonus->don = Don::findOrFail($bonus->don);
         $bonus->don->user = User::findOrFail($bonus->don->user);
      }
      return view("app.backoffice.users.parrain")->with('data',$data);
    }

    public function regUser($link)
    {
      $residences = Residence::all();
      return view('auth.register')->with(['link' => $link,"residences" => $residences ]);
    }

}
