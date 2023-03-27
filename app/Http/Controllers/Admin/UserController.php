<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use App\Models\StaffContact;
use App\Models\UserInstitution;
use Illuminate\Support\Facades\Gate;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Notification\EmailUserController;
use App\Http\Controllers\Notification\EmailValidationController;

class UserController extends Controller
{
    protected $email_user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->email_user = new EmailUserController();
    }

    public function index()
    {
        $response = Gate::inspect('isAdmin');
        if ($response->allowed()) {
            $users = User::with('roles','staff', "user_external_institution", "staff_contacts")
            ->whereNull('deleted_at')
            // ->where('u_id','<>', Auth::user()->u_id)
            ->orderBy('u_id', 'desc')
            ->get();

            $roles = Roles::where('r_id', '<>', 9)
            ->get();
            // dd($users);
            return view("admin.users_list",[
                'users' =>$users,
                'roles' => $roles
            ]);
        } else {
            //abort(403,$response->message());
            return redirect()->back()->with('error', $response->message());
        }

    }

    public function update_user_role(Request $request)
    {
        $response = Gate::inspect("isAdmin");
        if($response->allowed()){
            $rules = [
                // 'email' => 'required|email|max:191|unique:users,email,NULL,id,deleted_at,NULL',
                'nome_usuario' => 'required|min:3',
                'contacto' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'roles'=> 'required'
            ];

            $messages = array(
                'email.required' => translate('este_campo_obrigatorio'),
                'roles.required' => translate('este_campo_obrigatorio'),
                'nome_usuario.required' => translate('este_campo_obrigatorio'),
                'contacto.required' => translate('este_campo_obrigatorio'),
                'contacto.min' => translate('contacto_deve_conter'),
                'email.unique' => translate('email_cadastrado'),
            );
            

            $validator = Validator::make($request->all(), $rules, $messages);
            // dd($validator->errors());
            if ($validator->fails()) {
                return redirect()->back()->with('error',translate("ocorreu_erro"));
            }


            $old_user = User::where('u_id', base64_decode($request->input('user_id'))) ->whereNull('deleted_at')->first();
            // dd($old_user);
            // return (strcmp($old_user->email, $request->email) != 0)?$request->email:$old_user->email;
            if(strcmp($old_user->email, $request->email) != 0){ //email's diferentes
                // dd($old_user->email);
                $email =DB::table('users')->select('email')->where('email','like',$request->email)->first();

                if(!empty($email)){
                    dd($email);
                    return redirect()->back()->with('error', translate('email_cadastrado'));
                }
                $old_staff = Staff::where('s_id', $old_user->s_id)->first();

                Staff::where('s_id', $old_user->s_id)
                ->update([
                    'deleted_at'=>now(),
                ]);
                User::where('u_id', base64_decode($request->user_id))
                ->update([
                    's_id'=>$old_user->s_id,
                    'r_id' => base64_decode($request->roles),
                    'ui_id' => $old_user->ui_id,
                    'state' => $old_user->state,
                    'username' => $old_user->username,
                    'remember_token' => $old_user->remember_token,
                    'email' => (strcmp($old_user->email, $request->email) != 0)?$request->email:$old_user->email, //caso mude de email
                ]);

                

                Staff::create([
                    's_id' => $old_user->s_id,
                    's_name' => $request->input('nome_usuario'),
                    'created_at' => $old_staff->created_at,
                    'updated_at' => now()
                ]);

                $sc_id = DB::table('sc_staff_contact')->max('sc_id') + 1;
                StaffContact::where('u_id', $old_user->u_id)->whereNull('deleted_at')->update(['deleted_at'=>now()]);

                StaffContact::create([
                    'sc_id' => $sc_id,
                    'sc_contact' => $request->input('contacto'),
                    'u_id' => $old_user->u_id,
                    'updated_at' => now(),
                    'sc_updated_by'=>Auth::user()->u_id
                ]);


                // $user = User::create([
                //     'u_id' => $old_user->u_id,
                //     'id' => $old_user->id,
                //     's_id' => $old_staff->s_id,
                //     'r_id' => base64_decode($request->input('roles')),
                //     'ui_id' => $old_user->ui_id,
                //     'ui_id' => $old_user->ui_id,
                //     'state' => $old_user->state,
                //     'username' => $old_user->username,
                //     'remember_token' => $old_user->remember_token,
                //     'email' => (strcmp($old_user->email, $request->email) !== 0)?$request->email:$old_user->email, //caso mude de email
                //     'password' => $old_user->password,
                //     'created_at' => $old_user->created_at,
                //     'email_verified_at' => $old_user->email_verified_at,
                //     'updated_at' => now()
                // ]);
            }
            $old_staff = Staff::where('s_id', $old_user->s_id)->first();

                Staff::where('s_id', $old_user->s_id)
                ->update([
                    'deleted_at'=>now(),
                ]);
                if(!empty($old_staff)){

                    Staff::create([
                        's_id' => !empty($old_user)?$old_user->s_id:9999,
                        's_name' => $request->input('nome_usuario'),
                        'created_at' => !empty($old_staff)?$old_staff->created_at:now(),
                        'updated_at' => now()
                    ]);
                }

                $sc_id = DB::table('sc_staff_contact')->max('sc_id') + 1;
                StaffContact::where('u_id', $old_user->u_id)->whereNull('deleted_at')->update(['deleted_at'=>now()]);

                StaffContact::create([
                    'sc_id' => $sc_id,
                    'sc_contact' => $request->input('contacto'),
                    'u_id' => $old_user->u_id,
                    'updated_at' => now(),
                    'sc_updated_by'=>Auth::user()->u_id
                ]);

                User::where('u_id', base64_decode($request->input('user_id')))
                ->update([
                    'deleted_at'=>now(),
                    'email'=> base64_encode($old_user->email)
                ]);

                $user = User::create([
                    'u_id' => $old_user->u_id,
                    'id' => $old_user->id,
                    's_id' => !empty($old_staff)?$old_staff->s_id:NULL,
                    'r_id' => base64_decode($request->input('roles')),
                    'ui_id' => $old_user->ui_id,
                    'ui_id' => $old_user->ui_id,
                    'state' => $old_user->state,
                    'username' => $old_user->username,
                    'remember_token' => $old_user->remember_token,
                    'email' => (strcmp($old_user->email, $request->email) !== 0)?$request->email:$old_user->email, //caso mude de email
                    'password' => $old_user->password,
                    'created_at' => $old_user->created_at,
                    'email_verified_at' => $old_user->email_verified_at,
                    'updated_at' => now()
                ]);
            
            $message =array(
                'title' => "User account update",
                'body' => "Hello, your account details on our platform have been successfully updated."
            );
            $sendTo =  (strcmp($old_user->email, $request->email) !== 0)?$request->email:$old_user->email;
            $this->email_user->sendEmail($sendTo, $message, 'User account update');

            return redirect()->back()->with("info",translate("usuario_actualizado"));
        }else{
            abort(403);
            return redirect()->back()->with("error",$response->message);
        }

    }
    public function updateUserState($id)
    {
        $response = Gate::inspect("isAdmin");
        if($response->allowed()){
            $old_user = User::where('u_id', base64_decode($id))->whereNull('deleted_at')->first();
            User::where('u_id', base64_decode($id))->whereNull('deleted_at')
            ->update([
                'state' => ($old_user->state>0)?0:1
            ]);
            return redirect()->back()->with("error",translate('usuario_dasabilitado'));

        }else{
            abort(401, translate("erro"));
        }
    }


    public function register()
    {
        $response = Gate::inspect("isAdmin");
        if($response->allowed()){
            
            $roles = Roles::where('r_id', '<>', 9)
            ->get();
            $orgs = UserInstitution::whereNull('deleted_at')
            ->get();
            return view("admin.register",[
                'roles'=>$roles,
                'orgs'=>$orgs
            ]);
        }else{
            abort(403);
            return redirect()->back()->with("error",$response->message);
        }

    }

    public function store(Request $request)
    {
        $response = Gate::inspect("isAdmin");
        if($response->allowed()){
            $rules = [
                'email' => 'required|email|max:191|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\[\](){}~:;.,+#?!@$%^&*-]).{8,}$/',
                'password_2' => 'required_with:password|same:password|min:8',
                's_name' => 'required',
                'contacto' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'nome_instituicao'=> 'required',
                'role'=> 'required'
            ];

            $messages = array(
                'email.required' => translate('este_campo_obrigatorio'),
                'nome_instituicao.required' => translate('este_campo_obrigatorio'),
                'role.required' => translate('este_campo_obrigatorio'),
                'password.required' => translate('este_campo_obrigatorio'),
                's_name.required' => translate('este_campo_obrigatorio'),
                'contacto.required' => translate('este_campo_obrigatorio'),
                'contacto.contacto' => 'O contacto deve conter no mínimo de 9 dígitos',
                'email.unique' => translate('email_cadastrado'),
                'password.min' =>  translate('senha_conter_8_caracteres'),
                'regex' => translate('senha_conter_caracteres_especias')
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $instituicao = UserInstitution::where('ui_description', $request->input('nome_instituicao'))
            ->where('deleted_at', NULL)
            ->first();
            $id_instituicao='';

            if(empty($instituicao->ui_id)){
                $ui_id = DB::table('ui_user_institution')->max('ui_id') + 1;

                $id_instituicao = $ui_id;

                UserInstitution::create([
                    'ui_id' => $ui_id,
                    'ui_description' => $request->input('nome_instituicao'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }else{
                $id_instituicao = $instituicao->ui_id;
            }

            $s_id = DB::table('s_staff')->max('s_id') + 1;
            Staff::create([
                's_id' => $s_id,
                's_name' => $request->input('s_name'),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $u_id = DB::table('users')->max('u_id') + 1;

            User::create([
               'u_id' => $u_id,
               's_id' => $s_id,
               'r_id' => base64_decode($request->role),
               'id' => $u_id,
               'email' => $request->input('email'),
               'password' => Hash::make($request->input('password')),
               'ui_id' => $id_instituicao,
               'created_at' => now(),
               'updated_at' => now()
            ]);

            $sc_id = DB::table('sc_staff_contact')->max('sc_id') + 1;

            StaffContact::create([
                'sc_id' => $sc_id,
                'sc_contact' => $request->input('contacto'),
                'u_id' => $u_id,
                'sc_updated_by' => $u_id
            ]);

            $role = DB::table("r_roles")->select("r_name")->where('r_id', base64_decode($request->role))->first();

            $email = new EmailValidationController();  
            $sendTo = $request->email;
            $msg = "Hello, you have been registered on our platform  Please take a second to make sure we've got your email right.";

            $message = array(
                'title'=> 'Welcome to CISM',
                'body'=> $msg
            );
    
            $email->sendEmail($sendTo, $message, base64_encode($u_id), 'Welcome to CISM');
            
            return redirect()->back()->with("success", translate('usuario_registado'));
        }else{
            return $response->message;//redirect()->back()->with("error",$response->message);
            abort(403);
        }

    }
    protected function guard()
    {
        return Auth::guard();
    }

    public function blockedUser()
    {
        $users = User::with('roles','staff', "user_external_institution", "staff_contacts")
        ->where('loginAttempt', ">", 6)->whereNull('deleted_at')->get();
        
        return view('admin.blocked_users',[
            'users' => $users
        ]);
    }

    public function unlockUser($id)
    {
        $role = Gate::inspect("isAdmin");

        if($role->allowed()){
            User::where('u_id', base64_decode($id))
            ->update([
                'loginAttempt' => 0
            ]);
    
            return redirect()->back()->with('success', translate('usuario_desbloqueado'));
        }else{
            abort(401);
        }
    }
    
}
