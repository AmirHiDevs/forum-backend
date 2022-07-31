<?php

namespace App\Repositories;

use App\Interfaces\NotificationRepoInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class NotificationRepository implements NotificationRepoInterface
{
    public function index(): Builder
    {
        return Auth::user()->unreadNotifications();
    }
}
