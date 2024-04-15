<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUsersPaginated();
    public function storeUser(array $user);
    public function getUser(int $userId);
    public function updateUser(array $data, int $userId);
    public function deleteUser(int $userId);
}
