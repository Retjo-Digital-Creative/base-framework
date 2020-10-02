<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    return view('welcome');
});

if (Schema::hasTable('routes') && Schema::hasTable('route_groups')) {
    try {
        $routes = DB::table('routes')
            ->join('route_groups', 'routes.route_group_id', 'route_groups.id')
            ->select(
                DB::raw("concat(route_groups.name, '.', routes.name) as full_name,concat(route_groups.url, '/', routes.url) as full_url, route_groups.*, routes.*"),
            )->where(['route_groups.type' => 'api'])->get();

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
