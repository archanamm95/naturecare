<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;

use App\AssignedRoles;

class Admin
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**

    //asdadsdg
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
    public function __construct(
        Guard $auth,
        ResponseFactory $response
    ) {
        $this->auth = $auth;
        $this->response = $response;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
 
         
        if ($request->method() == 'POST' || $request->method() == 'PATCH') {
            $restricted_uri =[
                            // 'admin/users/edit',
                            // 'admin/change_transaction_password',
                            // 'admin/users/changeusername',
                            // 'admin/control-panel/branding',
                            // 'admin/control-panel/control-home-edit',
                            // 'admin/control-panel/add-product',
                            // 'admin/control-panel/category-edit',
                            // 'admin/control-panel/product-edit-post',
                            // 'admin/control-panel/postbackupmanager',
                            // // 'admin/control-panel/account-settings',
                            // 'admin/control-panel/btc_input',
                            // 'admin/control-panel/paypal_input',
                            // 'admin/control-panel/hyperwallet_input',
                            // 'admin/control-panel/commission-settings',
                            // 'admin/control-panel/design',
                            // 'admin/control-panel/design/font-size',
                            // 'admin/control-panel/performance/clear-cache-all',
                            // 'admin/control-panel/performance/clear-cache-routes',
                            // 'admin/control-panel/performance/cache-config',
                            // 'admin/control-panel/performance/clear-cache-application',
                            // 'admin/control-panel/performance/clear-cache-config',
                            // 'admin/control-panel/performance/clear-cache-views',
                            // 'admin/control-panel/idle-timeout',
                            // 'admin/control-panel/email_settings',
                            // 'admin/control-panel/organization-tree-settings',
                            // 'admin/control-panel/add-binarycommission',
                            // 'admin/control-panel/add-levelcommission',
                            // 'admin/control-panel/add-sponsorcommission',
                            // 'admin/control-panel/add-matchingbonus',
                            // 'admin/control-panel/rank-settings',
                            // 'admin/control-panel/mipayamount',
                            // 'admin/payout_options',
                            // 'admin/control-panel/blacklist-manager',
                            // 'admin/control-panel/ban-ip',
                            // 'admin/control-panel/uppaymentgateway-manager',
                            // 'admin/control-panel/chequepayment-manager',
                            // 'admin/control-panel/bitapspayment-manager',
                            // 'admin/control-panel/authorizepayment-manager',
                            // 'admin/control-panel/ravepayment-manager',
                            // 'admin/control-panel/paypalpayment-manager',
                            // 'admin/control-panel/stripepayment-manager',
                            // 'admin/control-panel/ipayghpayment-manager',
                            // 'admin/control-panel/skrillpayment-manager',
                            // 'admin/control-panel/currency-manager/add',
                            // 'admin/control-panel/postlanguagemanager',
                            // 'admin/control-panel/defaultlanguagechange',
                            // 'admin/control-panel/category',
                            // 'admin/control-panel/cms_manager',
                            // 'admin/control-panel/control-smtp_settings',
                            // 'admin/helpdesk/tickets/department',
                            // 'admin/helpdesk/tickets/category',
                            // 'admin/control-panel/voucher-manager/savelimit',
                            // 'admin/credit-fund',
                            // 'admin/payoutconfirm',
                            // 'admin/voucherlist',
                            // 'admin/control-panel/campaign-manager/add',
                           





            ];

                
            if (in_array($request->path(), $restricted_uri)) {
                    return redirect()->back()->withErrors(['Sorry, You dont have the permission to edit this setting']);
            }
        }
        if ($this->auth->check()) {
            $admin = 0;
            if ($this->auth->user()->admin==1) {
                $admin=1;
            }
            if ($admin==0) {
                return $this->response->redirectTo('/');
            }
            return $next($request);
        }
        return $this->response->redirectTo('/');
    }
}
