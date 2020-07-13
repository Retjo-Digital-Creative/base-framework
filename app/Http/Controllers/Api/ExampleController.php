<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;

class ExampleController extends Controller
{
    /**
     * Example api controller with Helpers::response()
     * Helpers::response() must get two parameter
     * [array $data, int $code, array $headers = optional]
     *
     * @return void
     */
    public function index()
    {
        return Helpers::response([
            'hello' => 'hello',
            'hallo' => 'hallo'
        ], 200, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
