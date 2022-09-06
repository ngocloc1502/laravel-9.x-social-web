<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inform extends Model
{
    use HasFactory;

    protected $table = 'inform';

    protected $primaryKey = 'id';

    protected $fillable = [
        'messages',
        'user_id',
        'status',
        'deadline',
    ];

    protected $casts = [
        'created_at' => 'date',
    ];

    public function getUserRelation()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getUserProgessRelation()
    {
        return $this->hasMany('App\Models\UserProgress', 'inform_id', 'id')
        ->where('status', 0);
    }
}
