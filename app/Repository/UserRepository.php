<?php

namespace App\Repository;

use App\Models\User;

class UserRepository implements UserPersistenceRepository
{

    public function save(array $data): User
    {
        return User::create($data);
    }
}
