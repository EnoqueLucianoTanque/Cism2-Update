<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCharter extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pc_project_charters';

    protected $fillable = [
        'pc_id',
        'p_id',
        'pc_objective',
        'pc_pi',
        'pc_co_pi',
        'pc_start_date',
        'pc_end_date',
        'created_at',
        'updated_at',
        'p_target_population',
        'pc_prelliminary_results',
        'p_data_collection_location',
        'p_main_procedure',
        'p_actual_state',
        'pc_created_by',
        'pc_updated_by',
        'pc_acronym'
    ];

    /**
     * Get all of the stories for the ProjectCharter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_stories()
    {
        return $this->hasMany(User::class, 'u_id', 'pc_updated_by')->with("staff");
    }

    /**
     * Get all of the study_reports for the ProjectCharter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function study_reports()
    {
        return $this->hasMany(DocumentProjectCharter::class, 'pc_id', 'pc_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'p_id', 'p_id')->with('project_stage_micro');
    }
}
