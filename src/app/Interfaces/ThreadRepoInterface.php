<?php

namespace App\Interfaces;


use App\Models\Thread;
use App\Notifications\NewReplySubmitted;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


interface ThreadRepoInterface
{
    public function index(): LengthAwarePaginator;

    public function show($slug): Model;

    public function store($title, $contents): Model;

    public function update($id,$title, $contents,$best_answer_id = null): bool;

    public function destroy($id): bool;

    public function find($thread_id);

    public function user($id): Model;
}
