<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ChannelRepoInterface
{
    public function getAll();
    public function create($name);
    public function update($id,$name);
}
