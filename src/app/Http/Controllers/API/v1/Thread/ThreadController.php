<?php

namespace App\Http\Controllers\API\v1\Thread;

use App\Http\Controllers\Controller;
use App\Repositories\ThreadRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ThreadController extends Controller
{
    private $threadRepo;

    public function __construct(ThreadRepository $threadRepo)
    {
        $this->threadRepo = $threadRepo;
    }

    public function index(): JsonResponse
    {
        $allThreads = $this->threadRepo->index();

        return response()->json($allThreads, Response::HTTP_OK);
    }

    public function show($slug): JsonResponse
    {
        $thread = $this->threadRepo->show($slug);

        return response()->json($thread, Response::HTTP_OK);
    }
}
