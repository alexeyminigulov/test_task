<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public function workers()
    {
        return $this->hasMany('App\Worker', 'profession_id', 'id');
    }
}
