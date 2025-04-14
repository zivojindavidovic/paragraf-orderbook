<?php

namespace App\Services;

use App\Models\User;

interface UserPersistence
{
    public function registerUser(array $data): User;
}
