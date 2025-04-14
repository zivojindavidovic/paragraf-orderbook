<?php

namespace App\Services;

interface AuthUser
{
    public function login(array $data): void;

    public function logout(): void;
}
