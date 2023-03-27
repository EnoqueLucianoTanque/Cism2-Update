<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'p_projects';
    protected $fillable = [
        'p_id',
        'sa_id',
        's_created_by',
        'p_updated_by',
        'p_name',
        'p_description',
        'p_acronym',
        'p_consortium',
        'p_budget',
        'p_general_budget',
        'psm_id',
        'p_support_document',
        'p_web_url',
        'p_source',
        'p_end_date',
        'p_state',
        'p_actual_state',
        'p_target_population',
        'p_data_collection_location',
        "p_reasons",
        'p_submitted_at',
        'p_deadline',
        'u_id',
        'created_at',
        'deleted_at',
        'p_currency'
    ];
    protected $primaryKey = 'row_id';

//    protected $hidden = [
//        'row_id',
//    ];
//    public function author()
//    {
//        return $this->hasOne(User::class, 'u_id', 'u_id')->with('staff');
//    }

    public function conformities()
    {
        return $this->belongsTo(Conformity::class,'c_id','c_id')->with("user_created","project_conformities");
    }
    public function articles()
    {
        return $this->hasMany(Article::class, 'p_id', 'p_id')->with('files','task');
    }
    /**
     * Get the project_charter associated with the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project_charter()
    {
        return $this->hasOne(ProjectCharter::class, 'p_id', 'p_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'p_id', 'p_id')->with('subtasks','members','files', 'agenda_monitoria', 'task_conformities');
    }
    public function time_line()
    {
        return $this->hasOne(TimelineProject::class, 'p_id', 'p_id');
    }
    /**
     * Get the user that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_project()
    {
        return $this->hasOne(User::class, 'u_id', 'u_id')->with('staff', 'staff_contacts');
    }

    public function approval_by()
    {
        return $this->hasOne(User::class, 'p_updated_by', 'u_id')->with('staff');
    }

    /**
     * Get the user associated with the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project_research_area()
    {
        return $this->belongsTo(SearchArea::class, 'sa_id', 'sa_id');
    }
    public function project_user_collaborator()
    {
        return $this->belongsTo(CismProjectCollaborator::class, 'p_id', 'p_id')->with('cism_collaborator');
    }

    /**
     * Get all of the comments for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project_available_post_award()
    {
        return $this->hasMany(ProjectCharter::class, 'p_id', 'p_id');
    }

    /**
     * Get all of the comments for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function project_submitted()
    // {
    //     return $this->hasMany(ProjectState::class, 'p_id', 'p_id');
    // }
    public function work_group_project()
    {
        return $this->hasOne(WorkGroupProject::class, 'p_id', 'p_id')->where('ps_id','=',1)->with('work_group_member');
    }
    public function work_group_project_stage_two()
    {
        return $this->hasOne(WorkGroupProject::class, 'p_id', 'p_id')->with('work_group_member');
    }

    /**
     * Get all of the documentsProject for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentsProject()
    {
        return $this->hasMany(DocumentProject::class, 'p_id', 'p_id')->with('document_type');
    }

    /**
     * Get the project_stage associated with the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project_stage_micro()
    {
        return $this->hasOne(ProjectStageMicro::class, 'psm_id', 'psm_id')->with('project_stage');
    }
//    public function documents_stage_two()
//    {
//        return $this->hasMany(DocumentProject::class, 'p_id', 'p_id')->where('');
//    }
//    public function documents_stage_two(){
//        return  $this->belongsToMany(ProjectStageMicro::class, "dp_document_project","g_id", 'p_id')->withPivot('gr_price','gr_start_date','gr_created_by','gr_created_at', 'gr_id', 'r_id')->where('gr_group_rate.gr_end_date', '>', now());
//    }
    public function project_state()
    {
        return $this->hasOne(ProjectState::class, 'p_id', 'p_id')->with('project_state');
    }
    // public function get_all_project_preparation($id)
    // {
    //     return $this->hasOne(ProjectState::class, 'p_id', 'p_id')->with('project_state')->where('s_id',$id);
    // }

}
