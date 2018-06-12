<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    protected $table = 'note';
    //
    public function projects()
    {
        return $this->hasOne('App\project','id');
    }
}
