<?php



use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class RolesTableSeeder extends Seeder
{

    public function run()
    {

        if (App::environment() === 'production') {
            exit('I just stopped you getting fired. Love, Amo.');
        }

        DB::table('roles')->truncate();


        \App\Role::create([
            'role_name'          => "menu.dashboard",
            'link'       => "admin/dashboard",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "icon-home4",
            'role_no'   => 1,
        ]);


         \App\Role::create([
            'role_name'          => "menu.network",
            'link'       => "#",
            'submenu_count'   => 3,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-tree",
            'role_no'   => 0,
        ]);
        
         \App\Role::create([
            'role_name'          => "tree.binary_genealogy",
            'link'       => "admin/genealogy",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 2,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 2,
        ]);

         \App\Role::create([
            'role_name'          => "menu.sponsor-genealogy",
            'link'       => "admin/sponsortree",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 2,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 3,
        ]);


         \App\Role::create([
            'role_name'          => "menu.tree-genealogy",
            'link'       => "admin/tree",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 2,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 4,
        ]);


         \App\Role::create([
            'role_name'          => "menu.admin",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-user",
            'role_no'   => 0,
        ]);
         
         \App\Role::create([
            'role_name'          => "menu.admin_register",
            'link'       => "admin/adminregister",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 6,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 5,
        ]);

          \App\Role::create([
            'role_name'          => "menu.view_all",
            'link'       => "admin/viewalladmin",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 6,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 6,
        ]);

        \App\Role::create([
            'role_name'          => "Members",
            'link'       => "#",
            'submenu_count'   => 8,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-user",
            'role_no'   => 0,
        ]);
         
         \App\Role::create([
            'role_name'          => "menu.list_all_members",
            'link'       => "admin/users",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 7,
        ]);

        \App\Role::create([
            'role_name'          => "menu.user_accounts",
            'link'       => "admin/useraccounts",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 8,
        ]);        


        \App\Role::create([
            'role_name'          => "menu.enroll_new_member",
            'link'       => "admin/register",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 9,
        ]); 

        \App\Role::create([
            'role_name'          => "menu.approve_payments",
            'link'       => "admin/approve_payments",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 10,
        ]);

        \App\Role::create([
            'role_name'          => "menu.change-password",
            'link'       => "admin/users/password",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 11,
        ]);
        \App\Role::create([
            'role_name'          => "menu.Change_Username",
            'link'       => "admin/users/changeusername",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 12,
        ]);
       \App\Role::create([
            'role_name'          => "users.pool_bonus",
            'link'       => "admin/users/pool-bonus",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 13,
        ]);

        \App\Role::create([
            'role_name'          => "menu.send_mail",
            'link'       => "admin/send-mail",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 14,
        ]);

        \App\Role::create([
            'role_name'          => "menu.wallets",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-university",
            'role_no'   => 0,
        ]);
         
         \App\Role::create([
            'role_name'          => "menu.wallets",
            'link'       => "admin/wallet",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 18,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 15,
        ]);

          \App\Role::create([
            'role_name'          => "Payout Request",
            'link'       => "admin/payoutrequest",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 18,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 16,
        ]);

        \App\Role::create([
            'role_name'          => "menu.support",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-envelope",
            'role_no'   => 0,
        ]);
         
         \App\Role::create([
            'role_name'          => "menu.mailbox",
            'link'       => "admin/inbox",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 21,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 17,
        ]);

          \App\Role::create([
            'role_name'          => "menu.tickets",
            'link'       => "admin/helpdesk/tickets-dashboard",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 21,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 18,
        ]);        

        \App\Role::create([
            'role_name'          => "menu.resources",
            'link'       => "#",
            'submenu_count'   => 4,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "icon-cogs",
            'role_no'   => 0,
        ]);
         
         \App\Role::create([
            'role_name'          => "menu.Documents",
            'link'       => "admin/documentupload",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 24,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 19,
        ]);

          \App\Role::create([
            'role_name'          => "menu.news",
            'link'       => "admin/getnews",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 24,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 20,
        ]);

        \App\Role::create([
            'role_name'          => "menu.videos",
            'link'       => "admin/addvideos",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 24,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 21,
        ]);

        \App\Role::create([
            'role_name'          => "menu.upload_users",
            'link'       => "admin/uploadusers",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 24,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 22,
        ]);


        \App\Role::create([
            'role_name'          => "menu.control_panel",
            'link'       => "admin/control-panel",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-cogs",
            'role_no'   => 23,
        ]);
        

        \App\Role::create([
            'role_name'          => "menu.profile",
            'link'       => "admin/userprofile",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "icon-home4",
            'role_no'   => 24,
        ]);
        \App\Role::create([
            'role_name'          => "Reports",
            'link'       => "#",
            'submenu_count'   => 10,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-envelope",
            'role_no'   => 0,
        ]);
         
         \App\Role::create([
            'role_name'          => "menu.joining-report",
            'link'       => "admin/joiningreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 25,
        ]);         
        \App\Role::create([
            'role_name'          => "menu.member-income-report",
            'link'       => "admin/incomereport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 26,
        ]); 
        \App\Role::create([
            'role_name'          => "report.leadership_pool_bonus",
            'link'       => "admin/pool-bonus",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 27,
        ]);  

        \App\Role::create([
            'role_name'          => "menu.top-earners-report",
            'link'       => "admin/topearners",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 28,
        ]);        
        \App\Role::create([
            'role_name'          => "menu.payout-report",
            'link'       => "admin/payoutreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 29,
        ]);        
        \App\Role::create([
            'role_name'          => "menu.sales_report",
            'link'       => "admin/salesreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 30,
        ]);       

         \App\Role::create([
            'role_name'          => "report.register_point_report",
            'link'       => "admin/rpreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 31,
        ]); 

         \App\Role::create([
            'role_name'          => "menu.summaryreport",
            'link'       => "admin/summaryreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 32,
        ]);        
        \App\Role::create([
            'role_name'          => "menu.inactive_user_report",
            'link'       => "admin/inactive_users",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 33,
        ]);

         \App\Role::create([
            'role_name'          => "report.user_details",
            'link'       => "admin/users-details",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 34,
        ]);
        \App\Role::create([
            'role_name'          => "Campaigns",
            'link'       => "#",
            'submenu_count'   => 5,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-paper-plane",
            'role_no'   => 0,
        ]);
         
         \App\Role::create([
            'role_name'          => "menu.create_new_campaign",
            'link'       => "admin/campaign/create",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 42,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 35,
        ]);        
        \App\Role::create([
            'role_name'          => "menu.manage_campaigns",
            'link'       => "admin/campaign/lists",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 42,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 36,
        ]);        
        \App\Role::create([
            'role_name'          => "menu.contacts_lists",
            'link'       => "admin/campaign/contacts",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 42,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 37,
        ]);          
        \App\Role::create([
            'role_name'          => "menu.autoresponders_list",
            'link'       => "admin/campaign/autoresponders",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 42,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 38,
        ]);              
        \App\Role::create([
            'role_name'          => "menu.create_autoresponder",
            'link'       => "admin/campaign/autoresponders/create",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 42,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 39,
        ]);  
        \App\Role::create([
            'role_name'          => "menu.stock_management",
            'link'       => "admin/stock_management",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 31,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   =>40,
        ]);           
    }
}
