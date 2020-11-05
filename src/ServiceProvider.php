<?php

namespace Reallyli\AliyunSts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class ServiceProvider.
 *
 * @author reallyli <zlisreallyli@outlook.com>
 */
class ServiceProvider extends LaravelServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;


    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/sts.php' => config_path('sts.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->singleton(Manager::class, function ($app) {
            return new Manager($app->config->get('sts', []));
        });

        $this->app->alias(Manager::class, 'aliyunsts');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [Manager::class, 'aliyunsts'];
    }
}
