<?php

namespace App\Repository;

use App\Models\User;

interface UserPersistenceRepository
{
    public function save(array $data): User;
}
