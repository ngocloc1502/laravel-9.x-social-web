<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogView extends Model
{
    use HasFactory;

    protected $table = 'blog_view';

    protected $fillable = [
        'blog_id',
        'user_id'
    ];
}
