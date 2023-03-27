<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkGroupMember;
use App\Models\Staff;
use App\Models\StaffContact;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class WorkGroupMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Gate::inspect('isInvestigator');
        if($response->allowed()){

            $rules = [
                'email' => 'required|email|max:191|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\[\](){}~:;.,+#?!@$%^&*-]).{8,}$/',
                'password2' => 'required_with:password|same:password|min:8',
                'nome_usuario' => 'required',
                'role__'=> 'required',
                'wgp_id'=> 'required',
            ];
            $messages = array(
                'email.required' => translate('este_campo_obrigatorio'),
                'password.required' => translate('este_campo_obrigatorio'),
                'nome.required' => translate('este_campo_obrigatorio'),
                'email.unique' => translate('email_cadastrado'),
                'password.min' => translate('senha_conter_8_caracteres'),
                'password2.same' => translate('digite_senhas_iguais'),
                'regex' => translate('senha_conter_caracteres_especias')
            );

            // dd($request->role);
            $validator = Validator::make($request->all(), $rules, $messages);
            // dd($validator->errors());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput()->with('warning', translate('ocorreu_erro'));
            }


            $wgm_id = DB::table('wgm_work_group_member')->max('wgp_id') + 1;
            $s_id=NULL;

            $staff_name = Staff::where('s_name', $request->input('nome_usuario'))->first();
            if(!empty($staff_name)){
                $s_id = $staff_name->s_id;

                WorkGroupMember::create([
                    'wgm_id' => $wgm_id,
                    'wgm_name' => $staff_name->s_name,
                    'wgm_description' => $staff_name->s_name,
                    'wgm_start_date' => now(),
                    's_id' => $staff_name->s_id,
                    // 'wgp_id' => 1,
                    'wgp_id' => $request->wgp_id,
                    'wgr_id' => base64_decode($request->role__),
                    'wgm_created_by' =>Auth::user()->u_id,
                    'wgm_updated_by' =>Auth::user()->u_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }else{
                $s_id = DB::table('s_staff')->max('s_id') + 1;
                Staff::create([
                    's_id' => $s_id,
                    's_name' => $request->input('nome_usuario'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                WorkGroupMember::create([
                    'wgm_id' => $wgm_id,
                    'wgm_name' => $request->nome_usuario,
                    'wgm_description' => $request->nome_usuario,
                    'wgm_start_date' => now(),
                    's_id' => $s_id,
                    // 'wgp_id' => 1,
                    'wgp_id' => $request->wgp_id,
                    'wgr_id' => base64_decode($request->role__),
                    'wgm_created_by' =>Auth::user()->u_id,
                    'wgm_updated_by' =>Auth::user()->u_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            }

            $u_id = DB::table('users')->max('u_id') + 1;

            $user = User::create([
               'u_id' => $u_id,
               's_id' => $s_id,
               'r_id' => 11, //Role = Study group
               'id' => $u_id,
               'email' => $request->input('email'),
               'password' => Hash::make($request->input('password')),
               'ui_id' => 1,
               'created_at' => now(),
               'updated_at' => now()
            ]);

            event(new Registered($users = $user));
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        }else{
            return redirect()->back()->with('error', translate('nao_tem_permissao'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
