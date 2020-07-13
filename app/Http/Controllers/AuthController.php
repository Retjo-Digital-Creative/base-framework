<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helpers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * @todo Setting route apabila user sudah login atau belum
 */
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
            return Helpers::response($validation->errors(), 422);
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
            return Helpers::response($validation->errors(), 422);
        }

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            return Helpers::response([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $createToken = $user->createToken('User token');
        $token = $createToken->token;

        if($request->remember_me) $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return Helpers::response([
            'message' => 'Success login',
            'token' => $createToken->accessToken
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
        $request->user()->token()->revoke();

        return Helpers::response([
            'code' => 200,
            'success' => true,
            'message' => 'Successfully logout'
        ], 200);
    }

    /**
     * Get user data
     *
     * @todo Masih belum setting routes apabila belum login
     * @param \Illuminate\Http\Request $request
     * @return \App\Helpers
     */
    public function user(Request $request)
    {
        return Helpers::response([
            'message' => 'Success get user data',
            'userData' => $request->user()
        ], 200);
    }
}
