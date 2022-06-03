<?php

namespace App\Mail;

use \App\Emails ;
use \App\Welcome ;
use \App\PendingTransactions ;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\AppSettings ;

class sendRegisteremailMailbale extends Mailable
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
        $setting=Welcome::first();
        $company_name=AppSettings::find(1)->company_name;;

        $pendingdata = PendingTransactions::where('username',$this->data['username'])->orderBy('id','desc')->first();
        $password = json_decode($pendingdata->request_data,true);
        $password = $password['password'];

        $return = $this->view('emails.register')
                    ->subject("Welcome Mail")
                    ->from($email->from_email, $email->from_name)
                    ->with([
                                'email'          => $email,
                                'company_name'  => $company_name,
                                'firstname'  => $this->data['firstname'],
                                'name'  => $this->data['lastname'],
                                'login_username'  => $this->data['username'],
                                'password'  => $password,
                                 
                            ]);
        return $return ;
    }
}
