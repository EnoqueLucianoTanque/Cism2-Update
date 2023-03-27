<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            's_name' => 'required|unique:s_staff'
        ];

        $validator = Validator::make($request->all(), $rules);
        //dd($validator);

        if ($validator->fails()) {
            return redirect()->back()->with('error','Usuário ja existe no sistema');
        }

        $s_id = DB::table('s_staff')->max('s_id') + 1;

        $staff = Staff::create([
            's_id' => $s_id,
            's_name' => $request->input('s_name')
        ]);


        //$staff = Staff::get();
        //dd($staff);

        return redirect()->back()->with([
            'Success' => translate('requisao_submetida_sucesso')
        ])->withInput();
    }

    public function show()
    {

    }
}
