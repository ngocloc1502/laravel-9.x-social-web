<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'uri'
    ];

    public function getNewsRelation()
    {
        return $this->hasMany('App\Models\News', 'category_id', 'id')->where('status', 0)
        ->withCount('getUserViewsRelation')->orderByDesc('get_user_views_relation_count');
    }
}
