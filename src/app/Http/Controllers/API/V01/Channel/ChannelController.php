<?php

namespace App\Http\Controllers\API\V01\Channel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    public function getAllChannels()
    {
        return response()->json(Channel::)
    }
}
