<?php

namespace AfterBug\AfterBugLaravel;

use AfterBug\Client;
use AfterBug\Config;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use AfterBug\AfterBugLaravel\Callbacks\User;
use Illuminate\Contracts\Container\Container;
use AfterBug\AfterBugLaravel\Request\LaravelRequest;

class AfterBugServiceProvider extends ServiceProvider
{
    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath($raw = __DIR__.'/../config/afterbug.php') ?: $raw;

        $this->publishes([
            $source => config_path('afterbug.php'),
        ]);

        $this->mergeConfigFrom($source, 'afterbug');
    }

    /**
     * Get the application paths except for the "vendor" directory.
     *
     * @return array
     */
    private function directoriesExceptVendor()
    {
        $basePaths = (new Filesystem())->directories(base_path());

        $vendorPath = [
            base_path('vendor'),
        ];

        return array_diff($basePaths, $vendorPath);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('afterbug', function (Container $app) {
            $config = $app->config->get('afterbug');

            $client = (new Client(new Config($config['api_key']), null, new LaravelRequest($app->request)))
                ->setSdk([
                    'name' => 'afterbug-laravel',
                    'version' => static::VERSION,
                ])
                ->setUserAttributes($config['user_attributes'])
                ->setApplicationPaths($this->directoriesExceptVendor())
                ->setEnvironment($app->config->get('app.env'))
                ->registerDefaultCallbacks()
                ->registerCallback(new User());

            return $client;
        });
    }
}
