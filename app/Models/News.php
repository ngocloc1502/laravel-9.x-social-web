<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'image',
        'content',
        'introduction',
        'category_id',
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

    public function getUserRelation()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getCategoryRelation()
    {
        return $this->belongsTo('App\Models\Categories', 'category_id', 'id');
    }

    public function getCommentsRelation()
    {
        return $this->hasMany('App\Models\NewsComments', 'news_id', 'id');
    }

    public function getUserViewsRelation()
    {
        return $this->belongsToMany('App\Models\User', 'news_view', 'news_id', 'user_id');
    }

    public function getCommentAlive() {
        return $this->getCommentsRelation()->where('status', 0);
    }

    
}
