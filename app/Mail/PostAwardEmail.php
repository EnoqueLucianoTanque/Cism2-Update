<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostAwardEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData, $subject, $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData=array(), $subject, $file=null)
    {
        $this->mailData = $mailData;
        $this->subject = $subject;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!empty($this->file)){

            return $this->markdown('email.post_award')
            ->subject($this->subject)
            ->attach($this->file, [
                'as'=>'documento',
                'mime'=> 'application/pdf' 
            ])
            ->with('mailData', $this->mailData);
        }else{
            return $this->markdown('email.post_award')
            ->subject($this->subject)
            ->with('mailData', $this->mailData);
        }
    }
}
