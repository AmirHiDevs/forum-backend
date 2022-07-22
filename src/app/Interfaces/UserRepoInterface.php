<?php

namespace App\Interfaces;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface UserRepoInterface
{
    public function create($name, $email, $password) : Model;
}
