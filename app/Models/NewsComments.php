<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsComments extends Model
{
    use HasFactory;

    protected $table = 'news_comments';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'content',
        'user_id',
        'news_id',
        'status',
    ];

    public function getUserRelation()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
