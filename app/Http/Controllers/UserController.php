<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\AddToBalanceRequest;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        return response()->json(["token" => $this->userService->login($request)], 200);
    }

    public function addToBalance(AddToBalanceRequest $request)
    {
        return (new UserResource($this->userService->addToBalance($request)));
    }

    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }
}
