<?php

namespace App\Http\Controllers\Pre_Writing\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecipientController extends Controller
{
    public function store($name)
    {
        $r_id = DB::table('r_recipients')->max('r_id') + 1;
        $recipient = new Recipient();
        $recipient->r_id = $r_id;
        $recipient->r_name = $name;
        $recipient->r_created_by = Auth::user()->u_id;
        $recipient->r_updated_by = Auth::user()->u_id;
        $recipient->save();

        return $r_id;
    }

    public function get()
    {

    }
}
