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
        $this->call([
            RouteSeeder::class,
            RouteGroupSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}
