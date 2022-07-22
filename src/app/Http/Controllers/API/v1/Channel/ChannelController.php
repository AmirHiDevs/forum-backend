<?php

namespace App\Http\Controllers\API\v1\Channel;

use App\Http\Requests\API\v1\Channel\CreateChannelRequest;
use App\Http\Requests\API\v1\Channel\DeleteChannelRequest;
use App\Http\Requests\API\v1\Channel\UpdateChannelRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Response;

class ChannelController extends Controller
{
    private $channelRepo;

    public function __construct(ChannelRepository $channelRepo)
    {
        $this->channelRepo = $channelRepo;
    }


    public function getChannel(): JsonResponse
    {
        $channels = $this->channelRepo->getAll();
        return response()->json($channels, Response::HTTP_OK);
    }

    public function createChannel(CreateChannelRequest $request): JsonResponse
    {
        $this->channelRepo->create($request->name);

        return response()->json([
            'message' => 'Channel Created Successfully.'
        ], Response::HTTP_CREATED);
    }

    public function updateChannel(UpdateChannelRequest $request): JsonResponse
    {
        $this->channelRepo->update($request->id,$request->name);

        return response()->json([
            'message' => 'Channel Updated Successfully.'
        ], Response::HTTP_OK);
    }

    public function deleteChannel(DeleteChannelRequest $request): JsonResponse
    {
        $this->channelRepo->delete($request->id);

        return response()->json([
            'message' => 'Channel Deleted Successfully.'
        ], Response::HTTP_OK);
    }
}
