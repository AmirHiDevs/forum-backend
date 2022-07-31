<?php

namespace App\Repositories;

use App\Interfaces\UserRepoInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @property EloquentBuilder $model
 */
class UserRepository implements UserRepoInterface
{

    public function __construct()
    {
        $this->model = User::query();
    }

    public function create($name, $email, $password): Model
    {
        return $this->model->create([
            'name'=> $name,
            'email'=> $email,
            'password'=> Hash::make($password)
        ]);
    }

    public function find($id): Collection
    {
        return $this->model->getModel()->find($id);
    }

    public function userNotifications(): QueryBuilder
    {
        return Auth::user()->unreadNotifications();
    }

    public function leaderboard(): LengthAwarePaginator
    {
        return $this->model->OrderByDesc('score')->paginate(15);
    }
}
