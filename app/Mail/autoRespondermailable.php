<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class autoRespondermailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $mail_user;
     public $from_name;
     public $from_email;

    public function __construct($mail_user, $from_name, $from_email)
    {
        $this->mail_user = $mail_user;
        $this->from_name = $from_name;
        $this->from_email = $from_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $return = $this->view('emails.autores')
                    ->subject($this->mail_user->subject)
                    ->from($this->from_email, $this->from_name)
                    ->with(['content' => $this->mail_user->content]);
        return $return ;
    }
}
