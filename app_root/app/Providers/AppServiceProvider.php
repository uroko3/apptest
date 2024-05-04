<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\PhpseclibV3\SftpConnectionProvider;
use League\Flysystem\PhpseclibV3\SftpAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    	Storage::extend('sftp', function ($app, $config) {
    		log::info('AppServiceProvider::boot sftp');
    		log::info($config);
    		
    		$adapter = new SftpAdapter(new SftpConnectionProvider(
    				$config['host'], // host (required)
    				$config['username'], // username (required)
    				$config['password'], // password (optional, default: null) set to null if privateKey is used
    				null, // private key (optional, default: null) can be used instead of password, set to null if password is set
    				null, // passphrase (optional, default: null), set to null if privateKey is not used or has no passphrase
    				$config['port'], // port (optional, default: 22)
    				false, // use agent (optional, default: false)
    				$config['timeout'], // timeout (optional, default: 10)
    				$config['max'], // max tries (optional, default: 4)
    				null, // host fingerprint (optional, default: null),
    				null, // connectivity checker (must be an implementation of 'League\Flysystem\PhpseclibV2\ConnectivityChecker' to check if a connection can be established (optional, omit if you don't need some special handling for setting reliable connections)
    			),
    			$config['root'], // root path (required)
    			PortableVisibilityConverter::fromArray([
    				'file' => [
    					'public' => 0640,
    					'private' => 0604,
    				],
    				'dir' => [
    					'public' => 0740,
//    					'private' => 7604,
    					'private' => 0740,
    				],
    			])
    		);
    		
    		return new FilesystemAdapter(
    			/*
    			new Filesystem($adapter, $config),
    			$adapter,
    			$config
    			*/
    			new Filesystem($adapter),
    			$adapter,
    		);
		});
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->bind(
    		\App\Repositories\SoyamaRepositoryInterface::class,
    		\App\Repositories\SoyamaRepository::class
    	);
    }
}
