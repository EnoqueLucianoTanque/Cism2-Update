<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStageMicro extends Model
{
    use HasFactory;
    protected $table = 'psm_project_stage_micro';
    protected $fillable = [
        'psm_id',
        'ps_id',
        'psm_name',
        'psm_level',
        'psm_description'
    ];

    /**
     * Get the project_stage associated with the ProjectStageMicro
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project_stage(){
        return $this->hasOne(ProjectStage::class, 'ps_id', 'ps_id');
    }
}
