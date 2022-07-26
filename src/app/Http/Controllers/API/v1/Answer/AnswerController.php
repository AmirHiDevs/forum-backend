<?php

namespace App\Http\Controllers\API\v1\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Answer\StoreAnswerRequest;
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
        $this->answerRepo->store($request->thread_id,$request->input('contents'));

        return response()->json([
            'message' => 'Answer is successfully created'
        ], Response::HTTP_CREATED);
    }
}
