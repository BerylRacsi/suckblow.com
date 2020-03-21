<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            'name' => 'Accomodation',
        ]);
        DB::table('facilities')->insert([
            'name' => 'Air Conditioning',
        ]);
        DB::table('facilities')->insert([
            'name' => 'Pool',
        ]);
        DB::table('facilities')->insert([
            'name' => 'Nitrox',
        ]);
    }
}
