<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invest extends Model
{
    protected $table = 'invest';
    //
    public function users()
    {
        return $this->hasOne('App\User','id','id_user')->select('id','name','avatar','linkprofile');
    }
}
