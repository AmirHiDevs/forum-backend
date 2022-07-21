<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\ChannelRepoInterface;
use App\Models\Channel;
use Illuminate\Support\Str;

class ChannelRepository implements ChannelRepoInterface
{
    public function getAll()
    {
        return Channel::all();
    }

    public function create($name)
    {
        Channel::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }

    public function update($id, $name)
    {
        Channel::find($id)->update([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
    }
}
