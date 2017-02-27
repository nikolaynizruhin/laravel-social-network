<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'birthday',
        'location',
        'website',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get the posts for the user.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the followers for the user.
     *
     * @return HasMany
     */
    public function followers()
    {
        return $this->belongsToMany(
            'App\User',
            'follows',
            'followee_id',
            'follower_id'
        )->withTimestamps();
    }

    /**
     * Get the followees for the user.
     *
     * @return HasMany
     */
    public function followees()
    {
        return $this->belongsToMany(
            'App\User',
            'follows',
            'follower_id',
            'followee_id'
        )->withTimestamps();
    }

    /**
     * Get the liked posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function likedPosts()
    {
        return $this->morphedByMany('App\Post', 'likeable');
    }
}
