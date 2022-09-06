<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComments extends Model
{
    use HasFactory;

    protected $table = 'blog_comments';

    protected $primaryKey = 'id';

    protected $fillable = [
        'content',
        'user_id',
        'blog_id',
        'status',
        'updated_at',
    ];

    public function getUserRelation() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getBlogRelation()
    {
        return $this->belongsTo('App\Model\Blog', 'blog_id', 'id');
    }
}
