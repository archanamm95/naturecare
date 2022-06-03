<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use \App\Emails ;


class AccountTermination extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = Emails::find(1);
        $return = $this->view('emails.termination')
                    ->subject('Account Termination Notice')
                    ->from($email->from_email, $email->from_name)
                    ->with([
                                'firstname'      => $this->data['name'],
                                'lastname'       => $this->data['lastname'] ,                                           
                                'username'       => $this->data['username']                                            
                            ]);
        return $return ;
    }
}
