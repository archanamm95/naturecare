<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class campaignRespondermail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $mail_user;

    public function __construct($mail_user)
    {
         $this->mail_user = $mail_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $return = $this->view('emails.mailtousers')
                    ->subject($this->mail_user->subject)
                    ->from($this->mail_user->from_email, $this->mail_user->first_name)
                    ->with([
                            
                            'name'=> $this->mail_user->name,
                            'content' => $this->mail_user->campaignemail,
                            ]);
        return $return ;
    }
}
