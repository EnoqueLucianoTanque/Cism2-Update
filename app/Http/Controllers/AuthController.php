<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Configuration\ConfigurationController;
use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use App\Models\StaffContact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\ThrottlesLogins;


class AuthController extends Controller
{
     use ThrottlesLogins;
    // protected $maxAttempts = 3;
    // protected $decayMinutes = 1; //Por enquanto vamos colocar 1min para testes

    protected $logs;


    public function __construct()
    {
        $this->logs = new LogsController();        
        // dd("throttle:".Configuration::getConfigurationType('maxAttempts').",".Configuration::getConfigurationType('decayMinutes'))->only('login');
        $this->middleware("throttle:".Configuration::getConfigurationType('maxAttempts')
        .",".Configuration::getConfigurationType('decayMinutes'))->only('login');
        // $this->middleware("throttle:2,1");

    }
    public function register()
    {
        return view('pre_writing.register');
    }


    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:191|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required',
            'password_2' => 'required',
            's_name' => 'required',
            'contacto' => 'required'
        ];
        //dd($request);
        $validator = Validator::make($request->all(), $rules);

        if(strcmp($request->input('password'), $request->input('password_2')) !== 0){
            return redirect()->back()->with('error','Digite senhas iguais');
        }
        //dd($request);

        if ($validator->fails()) {
            return redirect()->back()->with('error',$validator->errors());
        }

        //dd($validator->errors());
        $s_id = DB::table('s_staff')->max('s_id') + 1;
        Staff::create([
            's_id' => $s_id,
            's_name' => $request->input('s_name'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //dd($request->input('s_name'));
        $u_id = DB::table('users')->max('u_id') + 1;

        $user = User::create([
           'u_id' => $u_id,
           's_id' => $s_id,
           'r_id' => 1,
           'username' => $request->input('username'),
           'email' => $request->input('email'),
           'password' => Hash::make($request->input('password')),
           'created_at' => now(),
           'updated_at' => now()
        ]);

        $sc_id = DB::table('sc_staff_contact')->max('sc_id') + 1;

        StaffContact::create([
            'sc_id' => $sc_id,
            'sc_contact' => $request->input('contacto'),
            'u_id' => $u_id,
            'sc_updated_by' => $u_id,
        ]);
        return redirect()->route('auth');
    }
    public function auth()
    {

        return view('pre_writing.login');
    }


    protected function clearLoginAttempts(Request $request){
        $this->limiter()->clear($this->throttleKey($request));
    }

    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required'
        ];
        $messages = [
            'email.required' => translate('este_campo_obrigatorio'),
            'password.required' => translate('este_campo_obrigatorio'),
            'g-recaptcha-response.required' => translate('este_campo_obrigatorio'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        

        if ($validator->fails()) {
            $this->logs->store('failed',$request->ip(),NULL, now(), $request->email);
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        
        $loginAttempt = User::where('email', $request->email)->first();

        
        if(!empty($loginAttempt)){
            if($loginAttempt->loginAttempt > 6){
                $this->logs->store('failed',$request->ip(),NULL, now(), $request->email);
                return redirect()->back()->withErrors(['email'=>translate('conta_bloqueada')]);
            }
        }
        if(!Auth::attempt($request->only('email', 'password'))){
            DB::select('UPDATE users SET loginAttempt = loginAttempt + 1 WHERE email = "'.$request->email.'"');
            $this->logs->store('failed',$request->ip(),NULL, now(), $request->email );

           return redirect()->back()->withErrors(['email' => translate('email_password_invalido')])->withInput();
        }

        if(Auth::user()->state == 0){
            return redirect()->back()->withErrors([
                'email'=> translate('usuario_desativado')
            ])
            ->withInput();
        }
        $request->session()->save();
        $this->logs->store('success',$request->ip(),Auth::user()->u_id, now(), $request->email);
        User::where('u_id', Auth::user()->u_id)
        ->update([
            'loginAttempt' => 0
        ]);

        $this->clearLoginAttempts($request);
        $role = DB::table('r_roles')->where('r_id', Auth::user()->r_id)->first();
        $user_name = DB::table('users')
        ->join('s_staff', 's_staff.s_id', 'users.s_id')
        ->where('users.u_id', Auth::user()->u_id)
        ->first();

        $request->session()->put('user_id',Auth::user()->u_id);
        $request->session()->put('role',Auth::user()->r_id);
        $request->session()->put('role_name',$role->r_description);
        $request->session()->put('user_name', !empty($user_name)?$user_name->s_name:translate('nao_definido'));

        switch (Auth::user()->r_id) {
            
            case 1: // PI user
                return redirect()->route('pre_writing.investigator.project');
                break;
            case 2: //Pre Award manager
                return redirect()->route('pam.project_list');
                break;
            case 3: //Grant manager
                return redirect()->route('grant.project_list');
                break;
            case 4: //Grant manager
                return redirect()->route('configs_post_award.index');
                break; 
            case 5: //Grant manager;;
                return redirect()->route('configs_post_award.index');
                break;
            case 6: //Grant manager;
                return redirect()->route('configs_post_award.index');
                break;
            case 7: //Management;
                return redirect()->route('configs_post_award.index');
            case 8: //Management;
                return redirect()->route('configs_post_award.index');
                break;
            case 9: //Administrator;
                return redirect()->route("admin.dashboard");
                break;
            case 10: //Management;
                return redirect()->route('configs_post_award.index');
            break;
            case 11: //Administrator;
                return redirect()->route('study_phase.index');
                break;
            case 12: //Scientific DIrector;
                return redirect()->route('pam.project_list');
            break;
            default:
                break;
        }
        // self::$attempt = 0;
        // return $user;
    }

    protected function username(){
        return 'email';
    }

    public function logout(Request $request)
    {
        $cookie = Cookie::forget('jwt');
        $request->session()->flush();
        return redirect()->route('auth');
    }


}
