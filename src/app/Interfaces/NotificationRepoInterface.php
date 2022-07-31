<?php

namespace App\Interfaces;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;


interface NotificationRepoInterface
{
    public function index(): Builder;

    public function notifiableUser($thread_id): Collection;
}
