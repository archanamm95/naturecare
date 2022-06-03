<?php

use Illuminate\Database\Seeder;

class BackupSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\BackupSettings::create([
            'client_id'=>'828786941446-6e34n7mt35evlp8u80957oqbbtu9abn7.apps.googleusercontent.com',
            'client_secret'=>'oRRj90uKoFQyDR0Jt3dUOV89',
            'refresh_token' => '1/YVBXwjj2tzT75HmMRSPEl0g6oo54OPEoOrJz9rbQBSU',
         
            ]);
    }
}
