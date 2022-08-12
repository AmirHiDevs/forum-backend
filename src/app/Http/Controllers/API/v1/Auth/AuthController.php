<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Auth\LoginRequest;
use App\Http\Requests\API\v1\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(RegisterRequest $request): JsonResponse
    {

        $user = $this->userRepo->create($request->name, $request->email, $request->password);

        $defaultSuperAdminEmail = config('permission.default_super_admin_email');

        $user->email === $defaultSuperAdminEmail ? $user->assignRole('Super_Admin') : $user->assignRole('User');

        return response()->json([
            'message' => 'User is registered successfully.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {

        if (Auth::attempt($request->only(['email', 'password']))) return response()->json(Auth::user());

        throw ValidationException::withMessages([
            'email' => 'Incorrect credentials'
        ]);
    }

    public function userInfo(): JsonResponse
    {
            $data = [
                Auth::user(),
                'notifications' => Auth::user()->unreadNotifications(),
            ];
            return response()->json($data, Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }


}
