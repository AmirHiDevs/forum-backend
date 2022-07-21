<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface UserRepoInterface
{
    public function create(Request $request);
}
