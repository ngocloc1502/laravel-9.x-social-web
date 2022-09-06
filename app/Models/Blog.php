<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';  

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'content',
        'user_id',  
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getUserRelation() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getImagesRelation() {
        return $this->hasMany('App\Models\BlogImages', 'blog_id', 'id');
    }

    public function getCommentsRelation() {
        return $this->hasMany('App\Models\BlogComments', 'blog_id', 'id');
    }

    public function getUserLikesRelation() {
        return $this->belongsToMany('App\Models\User', 'blog_likes', 'blog_id', 'user_id')
        ->wherePivot('status', 0);
    }

    public function getUserViewsRelation() {
        return $this->belongsToMany('App\Models\User', 'blog_view', 'blog_id', 'user_id');
    }

    public function getCommentAlive() {
        return $this->getCommentsRelation()->where('status', 0);
    }
}
