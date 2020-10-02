<?php

use Illuminate\Database\Seeder;
use App\Models\Route;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Route;
        $table->name = "test";
        $table->function = "index";
        $table->method = "GET";
        $table->url = "/test";
        $table->route_group_id = 1; // ExampleController
        $table->save();
    }
}
