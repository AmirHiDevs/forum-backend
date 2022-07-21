<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
        ]);

        $this->userRepo->create($request);


        return response()->json([
            'message' => 'user registered successfully.'
        ], 201);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required', 'email', 'unique:users',
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(Auth::user());
        };

        throw ValidationException::withMessages([
            'email' => 'Incorrect credentials'
        ]);
    }

    public function userInfo(): JsonResponse
    {
        return response()->json(Auth::user());
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'message' => 'logged out successfully'
        ]);
    }


}
