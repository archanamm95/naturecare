<?php

use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\EmailTemplates::create([
            'subject'=>'An administrator created an account for you at [site:name]',
            'body'   =>'[user:name], A site administrator at [site:name] has created an account for you. You may now log in by clicking this link or copying and pasting it to your browser: [user:one-time-login-url] This link can only be used once to log in and will lead you to a page where you can set your password. After setting your password, you will be able to log in at [site:login-url] in the future using: username: [user:name] password: Your password -- [site:name] team',
            'type'  =>'user_by_admin',
            
            ]);
        App\EmailTemplates::create([
            'subject'=>'Account details for [user:name] at [site:name] (pending admin approval)',
            'body'   =>'[user:name],Thank you for registering at [site:name]. Your application for an account is currently pending approval. Once it has been approved, you will receive another e-mail containing information about how to log in, set your password, and other details.
                --  [site:name] team',
            'type'  =>'awaiting_approval',
            
            ]);
        App\EmailTemplates::create([
            'subject'=>'Account details for [user:name] at [site:name]',
            'body'   =>'[user:name],Thank you for registering at [site:name]. You may now log in by clicking this link or copying and pasting it to your browser: [user:one-time-login-url] This link can only be used once to log in and will lead you to a page where you can set your password. After setting your password, you will be able to log in at [site:login-url] in the future using: username: [user:name] password: Your password--  [site:name] team',
           'type'   =>'no_approval'
            ]);
        App\EmailTemplates::create([
            'subject'=>'Account details for [user:name] at [site:name] (approved)',
            'body'   =>'[user:name], Your account at [site:name] has been activated. You may now log in by clicking this link or copying and pasting it into your browser: [user:one-time-login-url] This link can only be used once to log in and will lead you to a page where you can set your password. After setting your password, you will be able to log in at [site:login-url] in the future using: username: [user:name] password: Your password --  [site:name] team',
            'type'  =>'account_activation',
            
            
            ]);
        App\EmailTemplates::create([
            'subject'=>'An administrator created an account for you at [site:name]',
            'body'   =>'[user:name], Your account on [site:name] has been blocked. --  [site:name] team',
            'type'  =>'account_blocked',
           
            ]);
        App\EmailTemplates::create([
            'subject'=>'Account cancellation request for [user:name] at [site:name]',
            'body'   =>'[user:name], A request to cancel your account has been made at [site:name]. You may now cancel your account on [site:url-brief] by clicking this link or copying and pasting it into your browser: [user:cancel-url] NOTE: The cancellation of your account is not reversible. This link expires in one day and nothing will happen if it is not used.--  [site:name] team',
            'type'  =>'cancel_confirm',
            
            ]);
        App\EmailTemplates::create([
            'subject'=>'Account details for [user:name] at [site:name] (canceled)',
            'body'   =>'[user:name],Your account on [site:name] has been canceled.--  [site:name] team',
            'type'  =>'account_canceled',
            
            ]);
        App\EmailTemplates::create([
            'subject'=>'Replacement login information for [user:name] at [site:name]',
            'body'   =>'[user:name],A request to reset the password for your account has been made at [site:name].You may now log in by clicking this link or copying and pasting it to your browser:[user:one-time-login-url]This link can only be used once to log in and will lead you to a page where you can set your password. It expires after one day and nothing will happen if its not used. --  [site:name] team',
            'type'  =>'password_recovery',
            
            ]);

         App\EmailTemplates::create([
            'subject'=>'Payout Notification [site:name]',
            'body'   =>'[user:name], Your Payout is received ',
            'type'  =>'payout_notify',
            
            ]);
    }
}
