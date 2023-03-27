<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailUser;
use Symfony\Component\HttpFoundation\Response;

class SendEmailUserController extends Controller
{
    public function sendEmail(){
        $sendTo = 'sandospaper@outlook.com';
        $mailData = [
            'title' => 'Notificacao do CISM',
            'body' => 'Mensagem de teste',
            'url' => 'https://www.tablutech.co.mz'
        ];
        Mail::to($sendTo)->send(new EmailUser($mailData));
        return response()->json([
            'message' => 'Email enviado com sucesso'
        ], Response::HTTP_OK);
    }
}
