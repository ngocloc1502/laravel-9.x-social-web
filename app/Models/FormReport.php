<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormReport extends Model
{
    use HasFactory;

    protected $table = 'form_reports';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function getReportsRelation()
    {
        return $this->belongsToMany('App\Models\Reports', 'post_reports', 'form_id', 'report_id');
    }
}
