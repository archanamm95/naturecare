<?php

use Illuminate\Database\Seeder;
use App\Models\ControlPanel\Options;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // App\Models\ControlPanel\Options::create([
         //   'company_name' => 'Cloud MLM Software',
         //   'company_email' => 'info@cloudmlmsoftware.com',
         //   'company_address' => 'Cloud MLM Software, Made with <3 by Bpract Software Solutions LLP,2nd Floor, Backer Business center, Calicut, Kerala, India - 673639',

         //   'logo_light' => 'logo_light.png',
         //   'logo_dark' => 'logo_dark.png',
         //   'logo_icon_light' => 'logo_icon_light.png',
         //   'logo_icon_dark' => 'logo_icon_dark.png',
         //  ]);
    

        $setting = $this->findOption('app.company_name');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.company_name'),
                'value'        => __('NATURE CARE'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Brand',
            ])->save();
        }


        $setting = $this->findOption('app.company_email');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.company_email'),
                'value'        => __('naturecaremalaysia@gmail.com'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
                'group'        => 'Brand',
            ])->save();
        }



        $setting = $this->findOption('app.company_address');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.company_address'),
                'value'        => __('<p>Nature Care
                    No 2, Medan Sunway Wellesley 2, Pusat Perniagaan Sunway Wellesley,14000 Bukit Mwerajam, Pulau Pinang</p>'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
                'group'        => 'Brand',
            ])->save();
        }




        $setting = $this->findOption('app.logo_light');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.logo_light'),
                'value'        => 'untitled-design-f0cdb.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 3,
                'group'        => 'Brand',
            ])->save();
        }

        $setting = $this->findOption('app.logo_dark');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.logo_dark'),
                'value'        => 'untitled-design-f0cdb.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 4,
                'group'        => 'Brand',
            ])->save();
        }

        $setting = $this->findOption('app.logo_icon_light');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.logo_icon_light'),
                'value'        => 'untitled-design-f0cdb.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 5,
                'group'        => 'Brand',
            ])->save();
        }

        $setting = $this->findOption('app.logo_icon_dark');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.logo_icon_dark'),
                'value'        => 'untitled-design-f0cdb.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 6,
                'group'        => 'Brand',
            ])->save();
        }


        $setting = $this->findOption('app.theme_skin');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.theme_skin'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 6,
                'group'        => 'Brand',
            ])->save();
        }


        $setting = $this->findOption('app.theme_font_size');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.theme_font_size'),
                'value'        => 'initial',
                'details'      => '',
                'type'         => 'text',
                'order'        => 6,
                'group'        => 'Brand',
            ])->save();
        }





        $setting = $this->findOption('app.tree_images_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_images_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Network',
            ])->save();
        }

        $setting = $this->findOption('app.tree_images_show_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_images_show_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Network',
            ])->save();
        }





        $setting = $this->findOption('app.tree_grid_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_grid_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Network',
            ])->save();
        }

        $setting = $this->findOption('app.tree_grid_show_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_grid_show_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Network',
            ])->save();
        }





        $setting = $this->findOption('app.tree_map_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_map_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Network',
            ])->save();
        }

        $setting = $this->findOption('app.tree_map_show_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_map_show_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Network',
            ])->save();
        }





        $setting = $this->findOption('app.tree_zooming_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_zooming_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Network',
            ])->save();
        }

        $setting = $this->findOption('app.tree_zooming_show_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_zooming_show_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Network',
            ])->save();
        }





        $setting = $this->findOption('app.tree_pan_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_pan_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Network',
            ])->save();
        }

        $setting = $this->findOption('app.tree_pan_show_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_pan_show_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Network',
            ])->save();
        }



        $setting = $this->findOption('app.tree_more_details_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_more_details_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Network',
            ])->save();
        }

        $setting = $this->findOption('app.tree_more_details_show_option');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tree_more_details_show_option'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Network',
            ])->save();
        }


        $setting = $this->findOption('app.cookie_prefix');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.cookie_prefix'),
                'value'        => 'cookie_',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'System',
            ])->save();
        }


        $setting = $this->findOption('app.idle_timeout');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.idle_timeout'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'System',
            ])->save();
        }


        $setting = $this->findOption('app.idle_timeout_delay');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.idle_timeout_delay'),
                'value'        => '900000',/*15 minute is 900000 - 1 minute 60000*/
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'System',
            ])->save();
        }





        $setting = $this->findOption('app.google_analytics_tracking_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.google_analytics_tracking_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Admin',
            ])->save();
        }

        
        $setting = $this->findOption('app.google_analytics_client_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.google_analytics_client_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Admin',
            ])->save();
        }
 
        $setting = $this->findOption('app.primary_menu_items');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.primary_menu_items'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Admin',
            ])->save();
        }




        $setting = $this->findOption('app.joining_fee');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.joining_fee'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.fast_start');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.fast_start'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.indirect_fast_start_level_one');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.indirect_fast_start_level_one'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.indirect_fast_start_level_two');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.indirect_fast_start_level_two'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.indirect_fast_start_level_three');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.indirect_fast_start_level_three'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.tax');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.tax'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }
        
        $setting = $this->findOption('app.service_charge');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.service_charge'),
                'value'        => 30,
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.binary_bonus');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.binary_bonus'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.matching_bonus_one');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.matching_bonus_one'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.matching_bonus_two');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.matching_bonus_two'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }

        $setting = $this->findOption('app.matching_bonus_three');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.matching_bonus_three'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Commission',
            ])->save();
        }


        $setting = $this->findOption('app.system_redirect_login');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.system_redirect_login'),
                'value'        => 'dashboard',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }

        $setting = $this->findOption('app.system_redirect');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.system_redirect'),
                'value'        => 'landing_page',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }
        $setting = $this->findOption('app.sponsor_commission');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.sponsor_commission'),
                'value'        => 25,
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }

        $setting = $this->findOption('app.payout_manual_bank');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.payout_manual_bank'),
                'value'        => '1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }


        $setting = $this->findOption('app.payout_hyperwallet');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.payout_hyperwallet'),
                'value'        => '0',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }

        $setting = $this->findOption('app.payout_paypal');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.payout_paypal'),
                'value'        => '0',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }
        
        $setting = $this->findOption('app.payout_btc');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.payout_btc'),
                'value'        => '0',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }
        $setting = $this->findOption('app.database_manager');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.database_manager'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }
        $setting = $this->findOption('app.user_registration');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.user_registration'),
                'value'        => 5,
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }
     // $setting = $this->findOption('app.visitors_only');
     //    if (!$setting->exists) {
     //        $setting->fill([
     //            'display_name' => __('options.app.visitors_only'),
     //            'value'        => '',
     //            'details'      => '',
     //            'type'         => 'text',
     //            'order'        => 8,
     //            'group'        => 'settings',
     //        ])->save();
     //    }
     // $setting = $this->findOption('app.visitors_by_administrator_approval');
     //    if (!$setting->exists) {
     //        $setting->fill([
     //            'display_name' => __('options.app.visitors_by_administrator_approval'),
     //            'value'        => '',
     //            'details'      => '',
     //            'type'         => 'text',
     //            'order'        => 8,
     //            'group'        => 'settings',
     //        ])->save();
     //    }
        $setting = $this->findOption('app.email_verification');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.email_verification'),
                'value'        => 1,
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }

          $setting = $this->findOption('app.gtag_value');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.gtag_value'),
                'value'        => __('UA-70977094-2'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }

           $setting = $this->findOption('app.voucher_user_request');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.voucher_user_request'),
                'value'        => __('yes'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }

           $setting = $this->findOption('app.voucher_admin_approval');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('options.app.voucher_admin_approval'),
                'value'        => __('yes'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'settings',
            ])->save();
        }
    }

     /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findOption($key)
    {
        return Options::firstOrNew(['key' => $key]);
    }
}
