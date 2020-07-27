<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(["middleware" => "auth"],function(){
    Route::group(["namespace" => "t2or"],function(){
        Route::get('/dashboard',[
          "as" => "dashboard",
          "uses" => "AdministrationController@dashboard"
        ]);
        Route::get("/adhesions",[
          "as" => "adhesions",
          "uses" => "AdhesionsController@index"
        ]);

        //Gestion des administrateurs
        Route::group(["prefix" => "administrateurs"],function(){
              Route::get("/",[
                "as" => "administrators",
                "uses" => "UsersController@adminspace"
              ]);
              Route::post("/add",[
                "as" => "administrator.add",
                "uses" => "UsersController@addAdmin"
              ]);
              Route::get("/lou/{id}",[
                "as" => "administrator.lou",
                "uses" => "UsersController@lockOrUnlockUser"
              ]);
              Route::get("/deleteAdmin/{id}",[
                "as" => "administrator.delete",
                "uses" => "UsersController@deleteAdmin"
              ]);
        });

        Route::group(["prefix" => "masters"],function(){
            Route::get("/",[
              "as" => "masters",
              "uses" => "UsersController@masterspace"
            ]);

            Route::post("/add",[
              "as" => "master.add",
              "uses" => "UsersController@addMaster"
            ]);

            Route::get("/deleteMasters/{id}",[
              "as" => "master.delete",
              "uses" => "UsersController@deleteMaster"
            ]);

            Route::get("/list-filleules/{link}",[
              "as" => "master.link",
              "uses" => "UsersController@filleulesList"
            ]);
        });

        Route::group(["prefix" => "packs"],function(){
          Route::get("/",[
            "as" => "packs",
            "uses" => "PacksController@index"
          ]);
          Route::post("/add",[
            "as" => "pack.create",
            "uses" => "PacksController@create"
          ]);
          Route::get("/edit/{id}",[
            "as" => "packs.edit",
            "uses" => "PacksController@edit"
          ]);
          Route::post("/update",[
            "as" => "pack.update",
            "uses" => "PacksController@update"
          ]);
          Route::get("/delete/{id}",[
            "as" => "pack.delete",
            "uses" => "PacksController@delete"
          ]);
        });

    });

    Route::get("/parrains",[
      "as" => "parrains",
      "uses" => "t2or\UsersController@parrainspace"
    ]);

});
Route::get("/register/{link}",[
  "as" => "reg",
  "uses" => "t2or\UsersController@regUser"
]);
Route::post("/user/create",[
  "as" => "user.register",
  "uses" => "Auth\RegisterController@addSuser"
]);

Auth::routes();


//Route::get('/reg-st2or',"Auth\RegisterController@stoorAdd");
