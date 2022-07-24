<?php

namespace App\Repositories;

use App\Interfaces\ThreadRepoInterface;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Builder $model
 */
class ThreadRepository implements ThreadRepoInterface
{
    public function __construct()
    {
        $this->model = Thread::query();
    }

    public function index(): Collection
    {
       return $this->model->Where('flag',true)->latest()->get();
    }


    public function show($slug): Model
    {
        return $this->model->Where('slug',$slug)->Where('flag',true)->first();
    }
}
