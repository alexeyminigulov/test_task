<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'profession_id', 'salary', 'photo',
    ];

    public function position()
    {
        return $this->belongsTo('App\Profession', 'profession_id', 'id');
    }

    public function scopeGetByIds($query, $ids)
    {
        return $query->whereIn('id', $ids);
    }
}
