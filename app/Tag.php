<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable=['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * POST relation
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
