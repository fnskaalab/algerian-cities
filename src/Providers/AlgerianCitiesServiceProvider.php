<?php

namespace Elhousseyn\AlgerianCities\Providers;

use Illuminate\Support\ServiceProvider;

class AlgerianCitiesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Migrations
        $this->publishes([
            __DIR__.'/../../database/migrations/create_cities_table.php.stub' =>
                database_path('migrations') . '/' . $this->getMigrationFileName('create_cities_table.php'),
                    
        ], 'migrations');

        // Seeds
        $this->publishes([
            __DIR__.'/../../database/seeders/' => database_path('seeders'),
        ], 'seeds');

        // models

        $this->publishes([
            __DIR__ . '/../State.php' => base_path('App/Models/State.php'),
            __DIR__ . '/../City.php' => base_path('App/Models/City.php')
        ]);
        
        // Commande
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Elhousseyn\AlgerianCities\Console\Commands\AlgerianCitiesCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Config file
         *
         * Uncomment this function call to load the config file.
         * If the config file is also publishable, it will merge with that file
         */
        // $this->mergeConfigFrom(
        //     __DIR__.'/../../config/algerian-cities.php', 'algerian-cities'
        // );
    }

    protected function getMigrationFileName($file_name)
    {
        return date('Y_m_d_His') . '_' . $file_name;
    }
}
