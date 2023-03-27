<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostAwardEmail;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostAwardNotification extends Controller
{
    // public function getEmailUsers($r_id)
    // {
    //     $data = DB::select('SELECT email FROM users WHERE r_id = ? AND deleted_at IS NULL ', [$r_id]);
    //     $emails =array();
    //     if(!empty($data)){
    //         foreach($data as $row){
    //             array_push($emails,
    //                 $row->email
    //             );
    //         }
    //     }
    //     return $emails;
    // }

    public function sendEmail($sendTo=array(), $message=array()) 
    {

        $mailData = [
            'title' => $message['title'],
            'body' => $message['body'],
            'document' => $message['document'],
            'subject' => $message['subject']
        ];

        Mail::to($sendTo)->send(new PostAwardEmail($mailData, $mailData['subject'], $mailData['document']));

        return response()->json([
            'message' => 'Notificação enviada com sucesso'
        ], Response::HTTP_OK);
    }
}
