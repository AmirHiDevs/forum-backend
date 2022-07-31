<?php

namespace App\Repositories;

use App\Interfaces\UserRepoInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @property Builder $model
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
}
