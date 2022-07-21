<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Models\Channel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;

class ChannelController extends Controller
{
    private $channelRepo;

    public function __construct(ChannelRepository $channelRepo)
    {
        $this->channelRepo = $channelRepo;
    }


    public function getAllChannels()
    {
        return response()->json(Channel::all());
    }

    public function createNewChannel(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $this->channelRepo->create($request->name);


        return response()->json([
            'message' => 'Channel Created successfully.'
        ], 201);
    }
}
