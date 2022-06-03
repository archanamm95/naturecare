<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\AppSettings;
use App\Settings;
use App\User;

// use Request;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
        $policy =Settings::find(1);
        $this->middleware('guest')->except('logout');
        $app = AppSettings::find(1);
        View::share('logo', $app->logo);
        View::share('logo_ico', $app->logo_ico);
        View::share('policy', $policy);

 
         $this->redirectTo  = ('dashboard' == option('app.system_redirect_login') ? '/user/dashboard' :  '/home' );
        if (\Request::get('redirectPath')) {
              $this->redirectTo = Request::get('redirectPath');
        }

        // dd( $this->redirectTo);
    }



    public function authenticated(Request $request, $user)
    {
        // return 3;
        
    // if ($user->id > 1) {
    //     auth()->logout();
    //      Session::flash('flash_notification', array('level' => 'error', 'message' => 'Software is currently down for maintenance administrator.'));
    //      return back()->with('error', 'Software is currently down for maintenance');

    // }

//user inactive


        // if ($user->active == 'pending') {
        //     auth()->logout();

        //         Session::flash('flash_notification', array('level' => 'error', 'message' => 'Sorry Your are not active, Please contact administrator.'));

        //     return back()->with('error', 'Sorry Your are not active, Please contact administrator');
        // }
       





        // $email_verification = option('app.email_verification');
        // if ($email_verification==1) {
        //     if (!$user->confirmed) {
        //         auth()->logout();

        //         Session::flash('flash_notification', array('level' => 'warning', 'message' => 'Your account is under verification.Wait until admin approval.'));


        //         return back()->with('warning', 'Your account is under verification.Wait until admin approval.');
        //     }
        //   }
        // //  else {
             if(isset($request->remember)){
               $current_time = time();
               $current_date = date("Y-m-d H:i:s", $current_time);
               $cookie_expiration_time = $current_time + (24*60*60);
               setcookie ("member_login",$request->username,$cookie_expiration_time);
               setcookie ("member_pass",$request->password,$cookie_expiration_time);
              }
              else{
               setcookie("member_login", "", time() - 3600);
               setcookie("member_pass", "", time() - 3600);
              }
          if(empty($user->keyid))
                User::where('id',$user->id)->update(['keyid' => 1]);
          else
                User::where('id',$user->id)->increment('keyid');

            return redirect()->intended($this->redirectPath());
        }
   





    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return property_exists($this, 'username') ? $this->username : 'username';
    }

    public function sociallogin($driver = 'facebook')
    {

       

                   echo Socialite::driver($driver)->redirect();
    }
    public function socialcallback(Request $request)
    {

            $user = Socialite::driver('facebook')->user() ;

            dd($user) ;
    }

    public function logout()
    {
        if (Auth::user()->id == 1)
            $url = '/login';
        else
            $url = env('SITE_URL');

        Session::flush();
        Auth::logout();
        return redirect()->to($url)->send();
    }
}
