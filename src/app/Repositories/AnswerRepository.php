<?php

namespace App\Repositories;

use App\Interfaces\AnswerRepoInterface;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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
}
