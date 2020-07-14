<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register user
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Helpers\Helpers
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required',
            'email' => 'string|required|email',
            'password' => 'string|required'
        ]);

        if($validation->fails()) {
            return Helpers::response([
                'code' => 422,
                'success' => false,
                'message' => 'Form validation failed!',
                'content' => $validation->errors()
            ], 422);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $createUser = User::create($data);

        return Helpers::response([
            'code' => 201,
            'success' => true,
            'message' => 'Success register!',
            'content' => $createUser
        ], 201);
    }

    /**
     * Login and create user token
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Helpers\Helpers
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'string|required|email',
            'password' => 'string|required',
            'remember_me' => 'boolean'
        ]);

        if($validation->fails()) {
            return Helpers::response([
                'code' => 422,
                'success' => false,
                'message' => 'Form validation failed!',
                'content' => $validation->errors()
            ], 422);
        }

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            return Helpers::response([
                'code' => 401,
                'success' => false,
                'message' => 'Authentication failed'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $createToken = $user->createToken('User token')->accessToken;

        return Helpers::response([
            'code' => 200,
            'success' => true,
            'message' => 'Success login',
            'content' => [
                'userData' => $user,
                'token' => $createToken
            ]
        ], 200);
    }

    /**
     * Logout and revoke user token
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::guard('api')
            ->user()
            ->token()
            ->revoke();

        return Helpers::response([
            'code' => 200,
            'success' => true,
            'message' => 'Successfully logout'
        ], 200);
    }
}
