<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkProject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LinkProjectController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'link.*' => 'required',
            'magazine_name' => 'required',
            'p_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        // dd($validator->errors());
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        foreach($request->link as $links){
            $lp_id = DB::table('lp_link_projects')->max('lp_id') + 1;
            $link_project = new LinkProject();
            $link_project->lp_id = $lp_id;
            $link_project->p_id = base64_decode($request->p_id);
            $link_project->lp_created_by = Auth::user()->u_id;
            $link_project->lp_updated_by = Auth::user()->u_id;
            $link_project->lp_name = 'Links de Artigos Científicos';
            $link_project->lp_magazine_name = $request->magazine_name;
            $link_project->lp_details = $request->details;
            $link_project->lp_link = $links;
            $link_project->lp_state = 1;
            $link_project->created_at = now();
            $link_project->updated_at = now();
            $link_project->lp_submitted_at = date('Y-m-d');
            $link_project->save();
        }
        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
    }
}
