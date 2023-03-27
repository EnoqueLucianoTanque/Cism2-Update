<?php

namespace App\Http\Controllers\Pre_writing\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectDateLimitController extends Controller
{
    public static function getDateDifference($project_id)
    {
        $nr_days = DB::select("SELECT DATEDIFF(CURRENT_DATE, DATE (p.p_submitted_at)) AS 'nr_dias' FROM p_projects p WHERE p.p_id = ? AND p.deleted_at IS NULL LIMIT 1;", [$project_id]);

        return $nr_days;
    }

    public static function setProjectLost($project_id)
    {
        $old_project = Project::where('p_id', $project_id)->whereNull('deleted_at')->first();
        #not found!!!!!
        Project::where('p_id', $project_id)->whereNull('deleted_at')
        ->update([
            'deleted_at' =>now()
        ]);

        Project::create([
            'p_id' => $project_id,
            'p_name' => $old_project->p_name,
            'p_acronym' => $old_project->p_acronym,
            'p_consortium' => $old_project->p_consortium,
            'p_description' => $old_project->p_description,
            'p_submitted_at' => $old_project->p_submitted_at,
            'p_end_date' => $old_project->p_end_date,
            'p_deadline' => $old_project->p_deadline,
            'p_budget' => $old_project->p_budget,
            'p_web_url' => $old_project->p_web_url,
            'p_support_document' => $old_project->p_support_document,
            'p_source' => $old_project->p_source,
            'p_general_budget' => $old_project->p_general_budget,
            'p_state' => 'Perdida',
            'u_id' => $old_project->u_id,
            'p_currency' => $old_project->p_currency,
            'sa_id' => $old_project->sa_id,
            'psm_id' => $old_project->psm_id,
            'p_updated_by' => 1,
            'created_at' => $old_project->created_at,
            'updated_at' => now(),
        ]);
        return true;
    }
}
