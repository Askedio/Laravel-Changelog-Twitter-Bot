<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'version', 'type', 'content', 'date', 'tweeted', 'link',
    ];

    protected $table = 'log';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function links()
    {
        return array_filter(explode(',', $this->link));
    }
}
