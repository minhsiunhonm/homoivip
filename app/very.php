<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class very extends Model
{
    protected $table = 'very';
    //
    public function users()
    {
        return $this->hasOne('App\User','id','id_user')->select('id','name','avatar','linkprofile');
    }
}
