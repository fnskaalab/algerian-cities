<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Carbon;
use Schema;
use Artisan;

class StatesCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if table exist
        if (! Schema::hasTable('states') || ! Schema::hasTable('cities')) {
            Artisan::call('migrate');
        }

        $cities = DB::table('states')->count();
        $towns = DB::table('cities')->count();

        if (!$cities && !$towns) {
            $this->loadData();
            $this->command->info("Success!! cities and towns are loaded successfully");
            return;
        }
        
        $this->command->comment("towns/cities already loaded");
    }


    protected function loadData()
    {
        $this->insertStates();
        $this->insertCities();
    }

    protected function insertStates()
    {
        // Load wilayas from json
        $states = json_decode(file_get_contents(database_path('seeders/json/Wilaya_Of_Algeria.json')));

        // Insert Wilayas
        $data = [];
        foreach ($states as $state) {
            $data[] = [
                'id'          => $state->id,
                'name'        => $state->name,
                'arabic_name' => $state->ar_name,
                'longitude'   => $state->longitude,
                'latitude'    => $state->latitude,
                'created_at'  => Carbon::now(),
            ];
        }
        DB::table('states')->insert($data);
    }

    protected function insertCities()
    {
        // Load wilayas from json
        $cities = json_decode(file_get_contents(database_path('seeders/json/Commune_Of_Algeria.json')));

        // Insert communes
        $data = [];
        foreach ($cities as $city) {
            $data[] = [
                'id'          => $city->id,
                'name'        => $city->name,
                'arabic_name' => $city->ar_name,
                'post_code'   => $city->post_code,
                'state_id'   => $city->wilaya_id,
                'longitude'   => $city->longitude,
                'latitude'    => $city->latitude,
                'created_at'  => Carbon::now(),
            ];
        }
        DB::table('cities')->insert($data);
    }
}
