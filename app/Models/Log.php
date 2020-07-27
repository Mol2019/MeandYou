<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = ["user","action"];

    public function user()
    {
      return $this->belongsTo("App\User","user","id");
    }
}
