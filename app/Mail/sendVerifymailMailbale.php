<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Emails;

class sendVerifymailMailbale extends Mailable
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
        $return = $this->view('emails.verify')
                    ->subject('Cloud MLM Software. Verify your E-mail address')
                    ->from($email->from_email, $email->from_name)
                    ->with([
                            'email'          => $email,
                            'email_address'  => $this->data['email'],
                            'company_name'   =>$this->data['company_name'],
                            'firstname'      => $this->data['firstname'],
                            'name'           => $this->data['lastname'],
                            'login_username' => $this->data['username'],
                            'password'       => $this->data['password'],
                            'confirmation_code'=> $this->data['confirmation_code']
                            ]);
        return $return ;
    }
}
