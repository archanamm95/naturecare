<?php

namespace App\Jobs;

use Mail;

use \App\Mail\sendRegisteremailMailbale ;
use \App\Mail\sendVerifymailMailbale ;
use \App\Mail\sendUpgrademailMailbale;
use \App\Mail\AccountTermination;
use \App\Mail\sendEmailMailable;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public $data;
     public $toemail;
     public $name;
     public $type;
     public $tries = 1;
     public $timeout = 900;

    public function __construct($data, $toemail, $name, $type = 'register')
    {

                $this->data = $data;
                $this->toemail = $toemail;
                $this->name = $name;
                $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if ($this->type == 'register') {
            $emailclass = new sendRegisteremailMailbale($this->data);
        } elseif ($this->type == 'verify') {
            $emailclass = new sendVerifymailMailbale($this->data);
        } elseif ($this->type == 'plan_upgrade') {
            $emailclass = new sendUpgrademailMailbale($this->data);
        } elseif ($this->type == 'termination') {
            $emailclass = new AccountTermination($this->data);
        } elseif ($this->type == 'mailtemplate') {
            $emailclass = new sendEmailMailable($this->data);
        }
        Mail::to($this->toemail, $this->name)->send($emailclass);
    }
}
