<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ExampleController extends Controller {
    public static function index(){
        return response()->json("hallo");
    }
}
