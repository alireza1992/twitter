<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $appends=
        [
            'avatar',
            'profileUrl',
        ];

    /**
     * relation between posts and user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * get avatar of a user
     * @return string
     */
    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'x?s=45&d=mm';
    }

    /**
     * for json
     * @return string
     */
    public function getAvatarAttribute()
    {
        return $this->getAvatar();
    }

    /**
     * link to profile
     * @return string
     */
    public function getProfileUrlAttribute()
    {
        return route('users.profile',$this);
    }


    /**
     * route name instead if id
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isNot(User $user)
    {
        return $this->id !== $user->id;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isFollowing(User $user)
    {
        return (bool) $this->following->where('id',$user->id)->count();
    }

    public function canFollow(User $user)
    {
        if(!$this->isNot($user))
        {
            return false;
        }
        return !$this->isFollowing($user);
    }

    public function canUnFollow(User $user)
    {
        return  $this->isFollowing($user);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
      return $this->belongsToMany('App\User','follows','user_id','follower_id');
    }
    public function follower()
    {
      return $this->belongsToMany('App\User','follows','follower_id','user_id');
    }


}
