<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'table',
        'post_id',
        'content',
        'status',
    ];

    public function getUserRelation()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getFormReportRelation()
    {
        return $this->belongsToMany('App\Models\FormReport', 'post_reports', 'report_id', 'form_id');
    }

    public function getPostReportsRelation()
    {
        return $this->hasMany('App\Models\PostReports', 'report_id', 'id');
    }
}
