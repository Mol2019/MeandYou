<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $rules = array(
      'nom' => ['required', 'string', 'max:255'],
      "prenoms" => ['required', 'string', 'max:255'],
      "residence" => ['required|integer'],
      'email' => ['required', 'email', 'max:255',"unique:users"] ,
      "date2naissance" => 'required|date|before:2001-01-01',
      'password' => ['required','min:6',"confirmed"],
      "contact1" => ['required',"numeric"],
      "contact2" => ['required',"numeric"],
      "perfect_money" => ['required'],
    );

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data["photo"] != NULL) :
          $this->rules["photo"] ='image|mimes:jpeg,png,jpg,gif,svg';
        endif;
        return Validator::make($data, $this->rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['role'] = "suse";
        return User::create([
          'nom' => $data['nom'],
          "prenoms" => $data['prenoms'],
          "lien_parainage" => $data['lien_parainage'] ?? "ras",
          "photo" => $data['photo'],
          "residence" =>$data['residence'] ?? 1,
          'email' => $data['email'] ,
          "date2naissance" => $data['date2naissance'],
          'password' => Hash::make($data['password']),
          "contact1" => $data['contact1'],
          "contact2" => $data['contact2'],
          "perfect_money" => $data['perfect_money'],
        ]);
    }



    /**
     * Create a new master user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function addMaster(Request $request)
    {
      if(Auth::user()->role == "admin"):

        $request->validate($this->rules);

        $count = User::all()->count();
        if($count > 0 && $count <= 10) :
          $data = $request->all();
          $data['role'] = "master";
          self::create($data);
        endif;

        return back()->with("success","Leader enregistré avec succès");

      else :
        return back()->with("error","Vous n'êtes pas autorisé à exécutez une telle action");
      endif;
    }

    /**
     * Create a new simple user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function addSuser(Request $request)
    {
        $request->validate($this->rules);
        $data = $request->all();
        $data['role'] = "suse";
        self::create($data);
        return back()->with("success","Leader enregistré avec succès");
    }
}


/*public function stoorAdd()
{
  $data = [
    'nom' => "Molou",
    "prenoms" => "Kouadio",
    "is_locked" => false ,
    "lien_parainage" => "blabla" ,
    "photo" => "",
    "residence" => 1,
    'email' => "meandyoucont@gmail.com" ,
    'password' => "mY@ca.sT2or.2107",
    "date2naissance" => "2020-07-21",
    "contact1" => "123",
    "contact2" => "123",
    "perfect_money" => "123",
  ];
  self::create($data);
}*/
