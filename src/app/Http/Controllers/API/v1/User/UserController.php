<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }


    public function index(): JsonResponse
    {
        return response()->json($this->userRepo->userNotifications(), Response::HTTP_OK);
    }


    public function leaderboard()
    {
        $this->userRepo->leaderboard();
    }

}
