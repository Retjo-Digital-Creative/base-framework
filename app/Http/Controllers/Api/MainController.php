<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function user(Request $request)
    {
        return Helpers::response([
            'code' => 200,
            'success' => true,
            'message' => 'Success get user data',
            'content' => [
                'userData' => Auth::guard('api')->user()
            ]
        ], 200);
    }
}
