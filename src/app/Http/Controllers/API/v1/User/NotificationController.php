<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{

    private $notificationRepo;

    public function __construct(NotificationRepository $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;
    }

    public function index(): JsonResponse
    {
        $userNotifications = $this->notificationRepo->index();
        return response()->json($userNotifications,Response::HTTP_OK);
    }
}
