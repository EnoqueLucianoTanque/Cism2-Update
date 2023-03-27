<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verifyEmail($id)
    {
        $user = User::where('u_id', base64_decode($id))->first();
        if(!empty($user)){
            User::where('u_id', $user->u_id)
            ->update([
                'email_verified_at' => now()
            ]);
        }
        return redirect()->route("auth");
    }
}
