<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReports extends Model
{
    use HasFactory;

    protected $table = 'post_reports';

    protected $primaryKey = 'id';

    protected $fillable = [
        'report_id',
        'form_id',
    ];
}
