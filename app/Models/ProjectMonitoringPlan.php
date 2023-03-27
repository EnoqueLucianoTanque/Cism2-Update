<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMonitoringPlan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pmp_project_monitoring_plans';

    protected $fillable = [
        'pmp_id',
        'p_id',
        'pmp_created_by',
        'pmp_updated_by',
        'pmp_monitoring_date',
        'pmp_monitoring_schedule_document_path',
        'created_at',
        'updated_at',
        'pmp_monitoring_schedule'
    ];
}
