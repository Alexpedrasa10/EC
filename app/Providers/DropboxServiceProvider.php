<?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Illuminate\Support\ServiceProvider;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {
        
            $client = new DropboxClient(
                //[$config['authorization_token'], $config['secret']] // Hacemos referencia al hash
                $config['authorization_token'] // Hacemos referencia al hash
            );

            return new Filesystem(new DropboxAdapter($client)); 
        });
    }
}