<?php

namespace App\Http\Controllers\API\v1\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Answer\DestroyAnswerRequest;
use App\Http\Requests\API\v1\Answer\StoreAnswerRequest;
use App\Http\Requests\API\v1\Answer\UpdateAnswerRequest;
use App\Http\Requests\API\v1\Channel\DeleteChannelRequest;
use App\Repositories\AnswerRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{

    private $answerRepo;

    public function __construct(AnswerRepository $answerRepo)
    {
        $this->answerRepo = $answerRepo;
    }

    public function index()
    {
        $this->answerRepo->index();
    }

    public function store(StoreAnswerRequest $request): JsonResponse
    {
        $this->answerRepo->store($request->thread_id, $request->input('contents'));

        return response()->json([
            'message' => 'Answer is successfully created'
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateAnswerRequest $request): JsonResponse
    {
        $this->answerRepo->update($request->id,$request->input('contents'));

        return response()->json([
            'message' => 'Answer is updated Successfully.'
        ], Response::HTTP_OK);
    }

    public function destroy(DestroyAnswerRequest $request): JsonResponse
    {
        $this->answerRepo->destroy($request->id);

        return response()->json([
            'message' => 'Answer is deleted Successfully.'
        ], Response::HTTP_OK);
    }
}
