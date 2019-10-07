<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'ok',
            'Threshold' => -1
        ]);

        DB::table('statuses')->insert([
            'name' => 'high',
            'Threshold' => 100
        ]);

        DB::table('warehouses')->insert([
            'Name' => 'Valgevase 13',
            'Longtitude' => 54.93212,
            'Latitude' =>  59.55432,
        ]);

        DB::table('warehouses')->insert([
            'Name' => 'Tööstuse 64',
            'Longtitude' => 54.93222,
            'Latitude' =>  59.55222,
        ]);
    }
}
