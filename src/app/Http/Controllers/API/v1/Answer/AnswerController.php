<?php

namespace App\Http\Controllers\API\v1\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Answer\DestroyAnswerRequest;
use App\Http\Requests\API\v1\Answer\StoreAnswerRequest;
use App\Http\Requests\API\v1\Answer\UpdateAnswerRequest;
use App\Repositories\AnswerRepository;
use App\Services\NotificationSendService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{

    protected AnswerRepository $answerRepo;

    public function __construct(AnswerRepository $answerRepo)
    {
        $this->answerRepo = $answerRepo;
    }

    public function index()
    {
        $this->answerRepo->index();
    }

    public function store(StoreAnswerRequest $request,NotificationSendService $sendService): JsonResponse
    {
        $this->answerRepo->store($request->thread_id, $request->input('contents'));

        Notification::send(
            $sendService->getUserInstance($request->thread_id),
            $sendService->notifyUserForNewReply($request->thread_id)
        );

        $this->answerRepo->score($request->input('thread_id'),10);

        return response()->json([
            'message' => 'Answer is successfully created'
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateAnswerRequest $request): JsonResponse
    {
        if (Gate::forUser(Auth::user())->allows('manage-answer', $this->answerRepo->user($request->id))) {

            $this->answerRepo->update($request->id, $request->input('contents'));

            return response()->json([
                'message' => 'Answer is updated Successfully.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Access Denied.'
        ], Response::HTTP_FORBIDDEN);

    }

    public function destroy(DestroyAnswerRequest $request): JsonResponse
    {
        if (Gate::forUser(Auth::user())->allows('manage-answer', $this->answerRepo->user($request->id))) {

            $this->answerRepo->destroy($request->id);

            return response()->json([
                'message' => 'Answer is deleted Successfully.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Access Denied.'
        ], Response::HTTP_FORBIDDEN);

    }
}
