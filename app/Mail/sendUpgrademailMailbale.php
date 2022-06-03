<?php

namespace App\Mail;

use \App\Emails ;
use \App\Welcome ;
use App\Packages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendUpgrademailMailbale extends Mailable
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
        $return = $this->view('emails.upgrade')
                    ->subject('Cloud MLM Software. Plan Upgradation ')
                    ->from($email->from_email, $email->from_name)
                    ->with([
                               'email'          => $email,
                                'email_address'  => $this->data['email'],
                                'company_name'   =>$this->data['company_name'],
                                'firstname'      => $this->data['firstname'],
                                'name'           => $this->data['lastname'],
                                
                                'upgrade'        => Packages::where('id', $this->data['plan'])->value('package'),
                                                                     
                                 
                            ]);
        return $return ;
    }
}
