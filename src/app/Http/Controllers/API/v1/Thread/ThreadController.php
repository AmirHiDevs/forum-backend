<?php

namespace App\Http\Controllers\API\v1\Thread;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Thread\StoreThreadRequest;
use App\Http\Requests\API\v1\Thread\UpdateThreadRequest;
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

    public function store(StoreThreadRequest $request): JsonResponse
    {
        $this->threadRepo->store($request->input('title'), $request->input('contents'));

        return response()->json([
            'message' => 'Thread is successfully created'
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateThreadRequest $request): JsonResponse
    {
        $this->threadRepo->update($request->id, $request->input('title'), $request->input('contents'));

        return response()->json([
           'message' => 'Thread is updated Successfully.'
        ],Response::HTTP_OK);

    }
}
