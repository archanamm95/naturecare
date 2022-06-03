<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Storage;
use App\BackupSettings;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        // $backup_settings=BackupSettings::find(1);
     
        // $this->app['config']->set('filesystems.disks.google.clientId', $backup_settings->client_id);
       
        // $this->app['config']->set('filesystems.disks.google.clientSecret', $backup_settings->client_secret);
        // $this->app['config']->set('filesystems.disks.google.refreshToken', $backup_settings->refresh_token);
        // $this->app['config']->set('filesystems.disks.google.folderId', $backup_settings->folder_id);

        // Storage::extend('google', function ($app, $config) {
       
        //     $client = new \Google_Client();
        //     $client->setClientId($config['clientId']);
        //     $client->setClientSecret($config['clientSecret']);
        //     $client->refreshToken($config['refreshToken']);
        //     $service = new \Google_Service_Drive($client);
        //     $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, $config['folderId']);
        //     return new \League\Flysystem\Filesystem($adapter);
        // });
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
