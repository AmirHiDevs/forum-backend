<?php

namespace App\Repositories;

use App\Interfaces\SubscribeRepoInterface;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property Builder $model
 */
class SubscribeRepository implements SubscribeRepoInterface
{


    public function __construct()
    {
        $this->model = Subscribe::query();
    }

    public function store($thread_id): Model
    {
        return $this->model->with('subscribes')->create([
            'thread_id' => $thread_id,
            'user_id' => Auth::id(),
        ]);
    }

    public function destroy($id,$thread_id): bool
    {
        return $this->model->find($id)->where([
            ["thread_id", $thread_id],
            ['user_id',Auth::id()]
        ])->delete();
    }
}
