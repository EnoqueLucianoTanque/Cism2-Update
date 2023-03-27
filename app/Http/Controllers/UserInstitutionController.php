<?php

namespace App\Http\Controllers;

use App\Models\UserInstitution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserInstitutionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function alter_state($id)
    {
        $old_organization = UserInstitution::where('ui_id', base64_decode($id))->whereNull('deleted_at')->first();
        
        UserInstitution::where('ui_id',base64_decode($id))
        ->update([
            'deleted_at' => now()
        ]);

        $organization = new UserInstitution();
        $ui_id = DB::table("ui_user_institution")->max("ui_id")+1;

        $organization->ui_id = $ui_id;
        $organization->ui_description = $old_organization->ui_description;
        $organization->ui_state = ($old_organization->ui_state==1)?0:1;
        $organization->created_at = $old_organization->created_at;
        $organization->updated_at = now();
        $organization->save();

        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
    }

    public function store(Request $request)
    {
        $role = Gate::inspect("isAdmin");
        if($role->allowed()){

            $rule = [
                'ui_name' => 'required'
            ];
    
            $validator = Validator::make($request->all(), $rule);
            if($validator->fails()){
                return redirect()->back()->with('error', translate('ocorreu_erro'));
            }
    
            $organization = new UserInstitution();
            $ui_id = DB::table('ui_user_institution')->max('ui_id') + 1;
    
            $organization->ui_id = $ui_id;
            $organization->ui_description = $request->ui_name;
            $organization->ui_state = 1;
            $organization->created_at = now();
            $organization->updated_at = now();
            $organization->save();
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        }else{
            abort(401, translate("nao_tem_permissao"));
        }
    }
}
