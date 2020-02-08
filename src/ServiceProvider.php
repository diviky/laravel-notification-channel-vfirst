<?php

namespace NotificationChannels\Vfirst;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(Channel::class)
            ->needs(Client::class)
            ->give(function () {
                return new Client(
                    $this->app->make(ChannelConfig::class)
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(ChannelConfig::class, function () {
            return new ChannelConfig($this->app['config']['services.vfirst']);
        });
    }
}
