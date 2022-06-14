<?php

namespace Elhousseyn\AlgerianCities\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Schema;
use Artisan;

class AlgerianCitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'algerian-cities:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload cities/towns';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Publish verndor
        Artisan::call('vendor:publish', ["--provider"=>"Elhousseyn\AlgerianCities\Providers\AlgerianCitiesServiceProvider"]);
        
        Artisan::call('db:seed --class=StatesCitiesSeeder');
    }
}
