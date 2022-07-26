<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface AnswerRepoInterface
{
    public function index():Collection;
}
