<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SocieteTableSeeder::class);
         $this->call(Liste_administratifSeeder::class);
    }
}
