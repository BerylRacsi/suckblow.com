<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agencies')->insert([
            'name' => 'PADI',
            'image' => 'images/agency/padi.png',
        ]);
        DB::table('agencies')->insert([
            'name' => 'SSI',
            'image' => 'images/agency/ssi.png',
        ]);
        DB::table('agencies')->insert([
            'name' => 'TDI',
            'image' => 'images/agency/tdi.png',
        ]);
        DB::table('agencies')->insert([
            'name' => 'GUE',
            'image' => 'images/agency/gue.png',
        ]);
        DB::table('agencies')->insert([
            'name' => 'NAUI',
            'image' => 'images/agency/naui.png',
        ]);
        DB::table('agencies')->insert([
            'name' => 'RAID',
            'image' => 'images/agency/raid.png',
        ]);
        DB::table('agencies')->insert([
            'name' => 'SDI',
            'image' => 'images/agency/sdi.png',
        ]);
    }
}
