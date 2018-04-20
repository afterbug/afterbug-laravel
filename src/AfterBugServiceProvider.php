<?php

namespace AfterBug\AfterBugLaravel;

use AfterBug\AfterBugLaravel\Callbacks\User;
use AfterBug\AfterBugLaravel\Request\LaravelRequest;
use AfterBug\Client;
use AfterBug\Config;
use Illuminate\Contracts\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

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
            $source => config_path('afterbug.php')
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
        return Arr::except(
            array_flip((new Filesystem())->directories(base_path())),
            [base_path('vendor')]
        );
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
                ->setApplicationPaths(array_flip($this->directoriesExceptVendor()))
                ->setEnvironment($app->config->get('app.env'))
                ->registerDefaultCallbacks()
                ->registerCallback(new User());

            return $client;
        });
    }
}
