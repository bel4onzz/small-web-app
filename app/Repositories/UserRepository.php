<?php

namespace App\Repositories;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUsersPaginated()
    {
        $users = User::latest()->search(request()->only('search'))->paginate(10);

        return [
            'users' => UserResource::collection($users)->response()->getData(true),
            'pagination' => $users
        ];
    }

    public function getUser(int $userId)
    {
        $user = User::where('id', $userId)->first();

        return [
            'user' => new UserResource($user),
        ];
    }

    public function storeUser(array $user)
    {
        $user = User::create($user);

        return $user;
    }

    public function updateUser(array $data, int $userId)
    {
        $user = User::find($userId);

        $user->update($data);

        return $user;
    }

    public function deleteUser(int $userId)
    {
        $user = User::find($userId);

        return $user->delete();
    }
}
