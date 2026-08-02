<?php

namespace Nexus;

use Illuminate\Support\ServiceProvider;

class NexusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/nexus.php', 'nexus');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'nexus');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../lang');
        $this->loadMigrationsFrom(__DIR__ . './Filament/Resources');
        // $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nexus');

        $this->publishes(
            [
                __DIR__ . '/../config/nexus.php' => config_path('nexus.php'),
            ],
            'nexus-config'
        );
    }
}
