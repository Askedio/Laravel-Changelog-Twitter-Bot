<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Author extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar', 'url', 'twitter', 'website'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function logs()
    {
      return $this->belongsToMany('App\Log');
    }

}
