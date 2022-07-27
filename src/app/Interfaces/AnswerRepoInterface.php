<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AnswerRepoInterface
{
    public function index(): Collection;

    public function store($thread_id,$contents): Model;

    public function update($id,$contents): bool;

    public function destroy($id): bool;

    public function user($id): Model;
}
