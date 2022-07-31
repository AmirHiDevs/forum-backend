<?php

namespace App\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


interface UserRepoInterface
{
    public function create($name, $email, $password): Model;

    public function find($id): Collection;
}
