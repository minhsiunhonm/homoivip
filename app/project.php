<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $table = 'project';
    
    public function users()
    {
        return $this->hasOne('App\User','id','id_user');
    }
}
