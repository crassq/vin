<?php

namespace Crassq\Vin;

use Illuminate\Support\ServiceProvider;

class VinServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('vin', static function () {
            return new Vin();
        });

        $this->app->alias('vin', Vin::class);
        $this->publishConfig();
        $this->publishLang();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishConfig(): void
    {
        $this->publishes([
            __DIR__.'/../Config/installer.php' => base_path('config/vin.php'),
        ], 'vin');

    }


    /**
     * Publish language file for the installer.
     *
     * @return void
     */
    protected function publishLang(): void
    {
        $this->publishes([
            __DIR__.'/../Lang' => base_path('lang'),
        ], 'vin');
    }
}
