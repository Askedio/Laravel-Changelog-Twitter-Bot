<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'date',
    ];

    protected $table = 'versions';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function logs()
    {
        return $this->hasMany('App\Log');
    }
}
