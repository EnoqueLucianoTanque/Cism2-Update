<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 't_task';
    protected $primaryKey = 't_id';
    protected $fillable = [
        't_id',
        't_name',
        't_description',
        't_start_date',
        'p_id',
        't_state',
        't_due_date',
        't_final_date',
        't_created_by',
        't_updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        't_local',
        't_objective',
        't_atual_state',
        't_preliminary_results',
    ];
    // protected $primaryKey = 't_id';
    public function subtasks()
    {
        return $this->hasMany(SubTask::class, 't_id', 't_id');
    }
    public function members()
    {
        return $this->hasMany(TaskMember::class, 't_id', 't_id')->with('staff');
    }

    public function files()
    {
        return $this->hasMany(File::class, 't_id', 't_id');
    }

    /**
     * Get the user associated with the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agenda_monitoria()
    {
        return $this->hasOne(TaskMonitoringPlan::class, 't_id', 't_id');
    }

    /**
     * The roles that belong to the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function task_conformities()
    {
        return $this->belongsToMany(Conformity::class, 'tc_task_conformities', 't_id', 'c_id');
    }

    /**
     * Get the user associated with the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function task_state()
    {
        return $this->hasOne(Config::class, 'c_id', 't_state');
    }
}
