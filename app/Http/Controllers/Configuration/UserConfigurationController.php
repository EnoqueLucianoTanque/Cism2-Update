<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use App\Models\StaffContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserConfigurationController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function index()
    {

        $user = User::with('roles','staff', "user_external_institution", "staff_contacts")
        ->where('u_id', Auth::user()->u_id)
        ->first();
        return view('configuration.user', ['user'=>$user]);
    }

    public function updateUser(Request $request)
    {
            $rules = [
                'email' => 'required|email|max:191',
                // 'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\[\](){}~:;.,+#?!@$%^&*-]).{8,}$/',
                // 'password2' => 'required_with:password|same:password|min:8',
                'nome' => 'required',
                'contacto' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            ];

            $messages = array(
                'email.required' =>  translate('este_campo_obrigatorio'), 
                'password.required' =>  translate('este_campo_obrigatorio'),
                'nome.required' =>  translate('este_campo_obrigatorio'),
                'contacto.required' =>  translate('este_campo_obrigatorio'),
                'email.unique' => translate('email_cadastrado'),
                'password.min' => translate('senha_conter_8_caracteres'),
                'password2.same' => translate('digite_senhas_iguais'),
                'contacto.regex' => translate('contacto_valido'),
                'regex' => translate('senha_conter_caracteres_especias')
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $old_user = User::where('u_id', Auth::user()->u_id)->first();

            Staff::where('s_id', $old_user->s_id)
            ->update([
                'deleted_at'=>now()
            ]);

            $s_id = DB::table('s_staff')->max('s_id') + 1;
            Staff::create([
                's_id' => $s_id,
                's_name' => $request->input('nome'),
                'created_at' => now(),
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

            User::where('u_id',Auth::user()->u_id)
            ->update([
                'r_id'=>Auth::user()->r_id,
                'email'=> $request->input('email'),
                'updated_at'=>now(),
                // 'password' => Hash::make($request->input('password')),
                's_id'=> $s_id
            ]);

            return redirect()->back()->with("info",translate('requisao_submetida_sucesso'));

    }
}
