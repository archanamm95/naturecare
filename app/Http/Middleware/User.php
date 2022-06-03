<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\AssignedRoles;
use App\BlockIP;
use Session;

class User
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The response factory implementation.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @param  ResponseFactory  $response
     * @return void
     */
    public function __construct(Guard $auth, ResponseFactory $response)
    {
        $this->auth = $auth;
        $this->response = $response;
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            $user = 0;
            if ($this->auth->user()->admin == 0) {
                $user = 1;
            }
            if ($user == 0) {
                return $this->response->redirectTo('/admin/dashboard');
            }
            if ($this->auth->user()->black_list == 1) {
                auth()->logout();
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'you are black listed'));
                return $this->response->redirectTo('/login');
            }
            $ip = request()->ip();
            $ip_count = BlockIP::where('ip', '=', $ip)->count();
            if ($ip_count >0) {
                auth()->logout();
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'This Ip Is Blocked'));
                return $this->response->redirectTo('/login');
            }
            return $next($request);
        }
        return $this->response->redirectTo('/');
    }
}
