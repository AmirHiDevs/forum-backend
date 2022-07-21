<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Models\Channel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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


    public function getAllChannels()
    {
        $channels = $this->channelRepo->getAll();
        return response()->json($channels,Response::HTTP_OK);
    }

    public function createNewChannel(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $this->channelRepo->create($request->name);


        return response()->json([
            'message' => 'Channel Created successfully.'
        ], Response::HTTP_CREATED);
    }

    public function updateChannel(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $this->channelRepo->update($request->id,$request->name);

        return response()->json([
            'message' => 'Channel Updated successfully.'
        ], Response::HTTP_OK);
    }
}
