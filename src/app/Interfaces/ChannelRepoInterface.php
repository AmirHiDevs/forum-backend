<?php

namespace App\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ChannelRepoInterface
{
    public function index(): Collection;

    public function store($name): Model;

    public function update($id, $name): bool;

    public function destroy($id): bool;
}
