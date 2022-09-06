<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_roles';

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
          'name',
          'slug'
     ];

     /**
      * The relationships between table Roles and table User
      *
      * @var array<string, string>
      */
     public function getUsersRelation()
     {
          return $this->belongsToMany('App\Models\User', 'admin_role_users', 'role_id', 'user_id');
     }
     
}
