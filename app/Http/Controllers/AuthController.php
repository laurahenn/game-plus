<?php

namespace App\Http\Controllers;

use Hash;
use JWTAuth;
use App\Users;
use Illuminate\Http\Request;
use App\Services\PasswordService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'logout', 'users']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            $user = Users::where('email', '=', request('email'))
                ->where('password', md5(request('password')))
                ->first();

            if ($user) {                                
                $token = JWTAuth::fromUser($user);

                return [
                    'success' => true,
                    'token' => $this->respondWithToken($token),
                    'user' => $user
                ];
            }

            return [
                'success' => false,
            ];
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();

        // return response()->json(['message' => 'Successfully logged out']);
        return [
            'success' => true,
        ];
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}