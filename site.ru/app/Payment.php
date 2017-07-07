<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment';

    protected $fillable = [
        'premium', 'salary', 'date', 'worker_id',
    ];

    public function worker()
    {
        return $this->belongsTo('App\Worker', 'worker_id', 'id');
    }

    public function scopeGetMonth($query, $month, $year)
    {
        return $query->whereRaw('MONTH(date) = ? and YEAR(date) = ?', [ $month, $year ]);
    }

    public function scopeGetWorker($query, $ids)
    {
        return $query->whereIn('worker_id', $ids);
    }
}
