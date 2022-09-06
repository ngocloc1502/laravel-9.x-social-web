<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber',
        'sex',
        'birthday',
        'avatar',
        'status',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    
    public function hasRole($role)
    {              
        return $this->belongsToMany('App\Models\AdminRoles', 'admin_role_users', 'user_id', 'role_id')
        ->where('slug', $role)
        ->exists();
    }
    
    /**
     * The relationships between table User and table Roles
     *
     * @var array<string, string>
     */
    public function getRoles()
    {
        return $this->belongsToMany('App\Models\AdminRoles', 'admin_role_users', 'user_id', 'role_id');
    }

    /**
     * The relationships between table User and table Blog
     *
     * @var array<string, string>
     */
    public function getBlogRelation() {
        return $this->hasMany('App\Models\Blog', 'user_id', 'id');
    }

    public function getBlogCommentsRelation()
    {
        return $this->hasMany('App\Models\BlogComments', 'user_id', 'id');
    }

    public function getBlogLikesRelation()
    {
        return $this->belongsToMany('App\Models\Blog', 'blog_likes', 'user_id', 'blog_id');
    }

    public function getBlogViewsRelation()
    {
        return $this->belongsToMany('App\Models\Blog', 'blog_view', 'user_id', 'blog_id');
    }


    /**
     * The relationships between table User and table News
     *
     * @var array<string, string>
     */
    public function getNewsRelation() {
        return $this->hasMany('App\Models\News', 'user_id', 'id');
    }

    public function getNewsCommentsRelation()
    {
        return $this->hasMany('App\Models\NewsComments', 'user_id', 'id');
    }

    public function getNewsViewsRelation()
    {
        return $this->belongsToMany('App\Models\News', 'news_view', 'user_id', 'news_id');
    }

    /**
     * The relationships between table User and table Inform
     *
     * @var array<string, string>
     */
    public function getInformsRelation()
    {
        return $this->hasMany('App\Models\Inform', 'user_id', 'id');
    }

    public function getUserProgessRelation()
    {
        return $this->hasMany('App\Models\UserProgess', 'user_id', 'id');
    }
}
