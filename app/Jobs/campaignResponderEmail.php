<?php

namespace App\Jobs;

use \App\Mail\campaignRespondermail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\CampaignGroup;

use App\Models\Marketing\Contact;
use App\User;
use Mail as Message;

class campaignResponderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

       public $mail;
      
       public $tries = 1;
       public $timeout = 900;

    public function __construct($mail)
    {
          $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
              $today=date('Y-m-d');
            if ($this->mail->datetime == $today) {
              // $users=User::where('id','>',1)->select('name','email')->get();
                   
                $users=Contact::where('list_id', $this->mail->customer_group)->select('name', 'email')->get();
                if (count($users) > 0) {
                    foreach ($users as $key => $user) {
                        $emailclass = new campaignRespondermail($this->mail);
                        Message::to($user->email, $user->name)->send($emailclass);
                    }
                }
            }
        } catch (\Exception $e) {
        }
    }
}
