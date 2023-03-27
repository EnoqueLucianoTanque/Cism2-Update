<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Notification\PostAwardNotification;
use App\Models\User;


class WorkGroupNotificationController extends Controller
{
    public function get_email_users()
    {
        $data = DB::table('t_task')
        ->join('tm_task_member', 'tm_task_member.t_id', 't_task.t_id')
        ->join('s_staff', 's_staff.s_id', 'tm_task_member.s_id')
        ->join('users', 'users.s_id', 's_staff.s_id')
        ->whereNull('t_task.deleted_at')
        ->where('t_task.t_final_date', date("Y-m-d"))
        ->where('t_state', 2)
        ->select('users.email', 't_name')
        ->get();
        return $data;
    }

    public function verify_task_final_date()
    {
        //return $this->get_email_users()->isNotEmpty();
        if($this->get_email_users()->isNotEmpty()){
            // return 'verdade';
            return $this->get_email_users();
        }
    }

    public function sendNotification()
    {
        $email_users = $this->get_email_users();
        $task = '';

        if($this->get_email_users()->isNotEmpty()){

            $email_notification = new PostAwardNotification();

            $sendTo = array();
            foreach ($email_users as $email) {
               array_push($sendTo, $email->email);
               $task =  $email->t_name;
            }

            $msg = 'Saudações, a previsão de término da tarefa "'. $task . '" \n é hoje!';

            $data = array(
                'title'=> 'Tarefa',
                'body'=> $msg,
                'document' => null,
                'subject' => 'Data de entrega da tarefa'
            );
            //return $data;
        $email_notification->sendEmail($sendTo, $data);
        return response()->json(['msg'=>'Notificação enviada', 'data'=>$sendTo], 200);
        }else{
            return response()->json(['status'=>false, 'msg'=>'nenhum email foi enviado.'], 200);
        }
    }
}
