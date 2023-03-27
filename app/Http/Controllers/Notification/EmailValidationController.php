<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailUser;
use Symfony\Component\HttpFoundation\Response;

class EmailValidationController extends Controller
{
    public function sendEmail($sendTo, $message=array(), $id_user, $subject)
    {
        $mailData = [
            'title' => $message['title'],
            'body' => $message['body'],
            'url' => route("user.verify_email", ['id'=>$id_user])
        ];
        
        // $subject = 'Email verification';

        Mail::to($sendTo)->send(new EmailUser($mailData, $subject));

        return response()->json([
            'message' => 'Notificação enviada com sucesso'
        ], Response::HTTP_OK); 
    }
}
