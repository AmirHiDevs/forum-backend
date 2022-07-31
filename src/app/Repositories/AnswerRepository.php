<?php

namespace App\Repositories;

use App\Interfaces\AnswerRepoInterface;
use App\Models\Answer;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class AnswerRepository implements AnswerRepoInterface
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Answer::query();
    }

    public function index(): Collection
    {
        return $this->model->get();
    }

    public function store($thread_id,$contents) : Model
    {
        return $this->model->create([
            'contents' => $contents,
            'thread_id' => Thread::query()->find($thread_id)->isRelation('answers'),
            'user_id' => Auth::id(),
        ]);
    }

    public function update($id,$contents): bool
    {
        return $this->model->find($id)->update([
            'contents' => $contents,
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

    public function score($thread_id,$amount)
    {
        if (Thread::with('answers')->find($thread_id)->user_id !== Auth::id()){
           Auth::user()->Increment('score',$amount);
        }
    }
}
