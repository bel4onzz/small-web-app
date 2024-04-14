<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUsersPaginated();
    public function storeUser(array $user);
}
