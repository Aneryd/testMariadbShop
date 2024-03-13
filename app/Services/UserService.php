<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\AddToBalanceRequest;

class UserService
{
    public function index($request)
    {
        return $request->user();
    }

    public function login(LoginRequest $request)
    {
        $user = User::firstOrCreate(['email' => $request->email]);

        return $user->createToken('token')->plainTextToken;
    }

    public function addToBalance(AddToBalanceRequest $request)
    {
        $request->user()->balance += $request->amount;
        $request->user()->save();

        return $request->user();
    }

    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }
}
