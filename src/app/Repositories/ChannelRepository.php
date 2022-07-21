<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\ChannelRepoInterface;
use App\Models\Channel;
use Illuminate\Support\Str;

class ChannelRepository implements ChannelRepoInterface
{
    public function create($name)
    {
        Channel::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }
}
