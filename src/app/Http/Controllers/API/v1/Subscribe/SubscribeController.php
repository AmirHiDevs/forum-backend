<?php

namespace App\Http\Controllers\API\v1\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Subscribe\DestroySubscribeRequest;
use App\Http\Requests\API\v1\Subscribe\StoreSubscribeRequest;
use App\Repositories\SubscribeRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SubscribeController extends Controller
{
    protected SubscribeRepository $subscribeRepo;

    public function __construct(SubscribeRepository $subscribeRepo)
    {
        $this->subscribeRepo = $subscribeRepo ;
    }
    public function store(StoreSubscribeRequest $request): JsonResponse
    {
        $this->subscribeRepo->store($request->thread_id);

        return response()->json([
            'message' => 'Subscription stored successfully.'
        ],Response::HTTP_CREATED);
    }

    public function destroy(DestroySubscribeRequest $request): JsonResponse
    {
        $this->subscribeRepo->destroy($request->id,$request->thread_id);

        return response()->json([
            'message' => 'Subscription removed successfully.'
        ],Response::HTTP_OK);
    }
}
