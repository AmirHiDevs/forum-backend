<?php

namespace App\Http\Controllers\API\v1\Channel;

use App\Http\Requests\API\v1\Channel\StoreChannelRequest;
use App\Http\Requests\API\v1\Channel\DestroyChannelRequest;
use App\Http\Requests\API\v1\Channel\UpdateChannelRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;
use Symfony\Component\HttpFoundation\Response;


class ChannelController extends Controller
{
    protected ChannelRepository $channelRepo;

    public function __construct(ChannelRepository $channelRepo)
    {
        $this->channelRepo = $channelRepo;
        $this->middleware(['permission:Manage_Channels','auth:sanctum'])->except('index');
    }


    public function index(): JsonResponse
    {
        $channels = $this->channelRepo->index();
        return response()->json($channels, Response::HTTP_OK);
    }

    public function store(StoreChannelRequest $request): JsonResponse
    {
        $this->channelRepo->store($request->input('name'));

        return response()->json([
            'message' => 'Channel is Created Successfully.'
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateChannelRequest $request): JsonResponse
    {
        $this->channelRepo->update($request->id, $request->input('name'));

        return response()->json([
            'message' => 'Channel is Updated Successfully.'
        ], Response::HTTP_OK);
    }

    public function destroy(DestroyChannelRequest $request): JsonResponse
    {
        $this->channelRepo->destroy($request->id);

        return response()->json([
            'message' => 'Channel is Deleted Successfully.'
        ], Response::HTTP_OK);
    }
}
