<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMenu extends Model
{
    use HasFactory;

    protected $table = 'post_menu';

    protected $primaryKey = 'id';

    protected $fillable = [
        'group',
        'title',
        'icon',
        'uri',
    ];
}
