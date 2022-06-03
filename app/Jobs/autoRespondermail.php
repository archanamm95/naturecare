<?php

namespace App\Jobs;

use \App\Mail\autoRespondermailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\CampaignGroup;

use App\Models\Marketing\Contact;
use App\Models\Marketing\EmailCampaign;
use App\User;
use Mail as Message;

class autoRespondermail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

       public $autoresponder;
       public $tries = 1;
       public $timeout = 900;

    public function __construct($autoresponder)
    {
         $this->autoresponder = $autoresponder;
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
             
              $emailcampaign=EmailCampaign::find($this->autoresponder->campaign);
              $send_date=date('Y-m-d', strtotime($emailcampaign->datetime. ' + '.$this->autoresponder->date.' days'));
              

            if ($send_date == $today) {
                $users=Contact::where('list_id', $emailcampaign->customer_group)->select('name', 'email')->get();
                if (count($users) > 0) {
                    foreach ($users as $key => $user) {
                        $emailclass = new autoRespondermailable($this->autoresponder, $emailcampaign->first_name, $emailcampaign->from_email);
                        Message::to($user->email, $user->name)->send($emailclass);
                    }
                }
            }
        } catch (\Exception $e) {
        }
    }
}
