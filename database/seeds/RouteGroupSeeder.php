<?php

use Illuminate\Database\Seeder;
use App\Models\RouteGroup;

class RouteGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new RouteGroup;
        $table->name = "example";
        $table->type = "web";
        $table->class = "\\App\\Http\\Controllers\\Admin\\ExampleController";
        $table->save();
    }
}
