<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    protected $table = 'team';
    
    public function users()
    {
        return $this->hasOne('App\User','id','id_user')->select('id','name','avatar','linkprofile');
    }
    public function project()
    {
        return $this->hasOne('App\project','id','id_project')->select('id');
    }
}
