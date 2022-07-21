<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ChannelRepoInterface
{
    public function create($name);
}
