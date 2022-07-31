<?php

namespace App\Interfaces;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;


interface UserRepoInterface
{
    public function create($name, $email, $password): Model;

    public function find($id): Collection;

    public function userNotifications(): QueryBuilder;

    public function leaderboard(): LengthAwarePaginator;

    public function isBlock() : bool;
}
