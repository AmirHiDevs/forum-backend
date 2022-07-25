<?php

namespace App\Repositories;

use App\Interfaces\ThreadRepoInterface;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        return $this->model->Where('flag', true)->latest()->get();
    }


    public function show($slug): Model
    {
        return $this->model->Where('slug', $slug)->Where('flag', true)->first();
    }

    public function store($title, $contents): Model
    {
        return $this->model->create([
            'title' => $title,
            'slug' => Str::slug($title),
            'contents' => $contents,
            'channel_id' => Channel::factory()->create()->id,
            'user_id' => Auth::id(),
        ]);
    }

    public function update($id,$title, $contents,$best_answer_id = null): bool
    {

        return $this->model->find($id)->update([
            'title' => $title,
            'slug' => Str::slug($title),
            'contents' => $contents,
            'channel_id' => Channel::factory()->create()->id,
            'best_answer_id' => $best_answer_id,
        ]);
    }

    public function destroy($id): bool
    {
       return $this->model->find($id)->delete();
    }

    public function user($id) : Model
    {
        return $this->model->find($id);
    }
}
