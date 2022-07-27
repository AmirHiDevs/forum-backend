<?php

namespace App\Http\Controllers\API\v1\Thread;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Thread\DestroyThreadRequest;
use App\Http\Requests\API\v1\Thread\StoreThreadRequest;
use App\Http\Requests\API\v1\Thread\UpdateThreadRequest;
use App\Repositories\ThreadRepository;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

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

        if (Gate::forUser(Auth::user())->allows('manage-thread',$this->threadRepo->user($request->id))) {
            $this->threadRepo->update(
                $request->id,
                $request->input('title'),
                $request->input('contents'),
                $request->input('best_answer_id')
            );

            return response()->json([
                'message' => 'Thread is updated Successfully.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Access Denied.'
        ], Response::HTTP_FORBIDDEN);


    }

    public function destroy(DestroyThreadRequest $request): JsonResponse
    {
        if (Gate::forUser(auth()->user())->allows('manage-thread', $this->threadRepo->user($request->id))) {
            $this->threadRepo->destroy($request->id);

            return response()->json([
                'message' => 'Thread is deleted Successfully.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Access Denied.'
        ], Response::HTTP_FORBIDDEN);
    }
}
