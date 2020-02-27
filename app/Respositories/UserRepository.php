<?php

namespace App\Respositories;


use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::query()->find($id);
    }
}