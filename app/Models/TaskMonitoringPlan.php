<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskMonitoringPlan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tmp_task_monitoring_plans';
    protected $fillable = [
        't_id',
        'tmp_created_by',
        'tmp_updated_by',
        'tmp_monitoring_date',
        'tmp_monitoring_schedule',
        'tmp_monitoring_schedule_document_path',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the agenda_monitoramento ad with the TaskMonitoringPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agenda_monitoramento()
    {
        return $this->belongsTo(Task::class, 't_id', 't_id');
    }
}
