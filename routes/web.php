<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

if (Schema::hasTable('routes') && Schema::hasTable('route_groups')) {
    try {
        $routes = DB::table('routes')
            ->join('route_groups', 'routes.route_group_id', 'route_groups.id')
            ->select(
                DB::raw("concat(route_groups.name, '.', routes.name) as full_name,concat(route_groups.url, '/', routes.url) as full_url, route_groups.*, routes.*"),
            )->where(['route_groups.type' => 'web'])->get();

        if (count($routes) > 0) {

            foreach ($routes as $route) {
                $middleware = [];
                if ($route->middleware != null) {
                    $middleware = explode('|', "" . $route->middleware);
                }
                if (count($middleware) > 0) {
                    $method = $routes->method;
                    Route::middleware($middleware)->$method($route->full_url, [$route->class, $route->function])
                        ->name($route->full_name);
                } else {
                    $method = $route->method;
                    Route::$method($route->full_url, [$route->class, $route->function])
                        ->name($route->full_name);
                }
            }
        }
    } catch (\Throwable $e) {
        printf($e);
    }
}
