<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function register(RegisterRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = bcrypt($inputs['password']);
        $user   = new Users($inputs);
        $user->save();
        return $this->responseOk(['user' => new UserResource($user)]);
    }
}
