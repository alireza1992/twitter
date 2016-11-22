<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['body'];

    protected $appends = ['humanCreatedAt'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * user relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * TAG relation
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }


    /**
     * @return mixed
     *
     */
    public function getHumanCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }




}