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
        'version_id', 'type', 'content', 'tweeted', 'link',
    ];

    protected $table = 'log';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'tweeted', 'version_id', 'updated_at', 'id'
    ];

    public function links()
    {
        return array_filter(explode(',', $this->link));
    }

    public function version()
    {
      return $this->belongsTo('App\Version');
    }

    public function authors()
    {
      return $this->belongsToMany('App\Author');
    }

}
