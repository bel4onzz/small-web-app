<?php

namespace App\Repositories;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUsersPaginated()
    {
        $users = User::latest()->search(request()->only('search'))->paginate(5);

        return [
            'users' => UserResource::collection($users)->response()->getData(true),
            'pagination' => $users
        ];
    }

    public function storeUser(array $user)
    {
        $user = User::create($user);

        return $user;
    }
}
