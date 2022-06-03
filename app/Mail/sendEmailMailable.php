<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use \App\Emails ;
use \App\AppSettings ;

class sendEmailMailable extends Mailable
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
        $app_settings = AppSettings::find(1);
        $return = $this->view('emails.mailtemplate')
                    ->subject($this->data->title)
                    ->from($email->from_email, $email->from_name)
                    ->with([
                                'company_name'   => $app_settings->company_name,
                                'email'          => $this->data->email_content ,                                           
                            ]);
        return $return ;
    }
}
