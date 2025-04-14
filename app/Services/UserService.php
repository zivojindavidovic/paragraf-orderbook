<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserPersistenceRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserService implements UserPersistence, AuthUser
{
    private UserPersistenceRepository $userPersistenceRepository;

    public function __construct(UserPersistenceRepository $userPersistenceRepository)
    {
        $this->userPersistenceRepository = $userPersistenceRepository;
    }

    public function registerUser(array $data): User
    {
        return $this->userPersistenceRepository->save($data);
    }

    /**
     * @throws ValidationException
     */
    public function login(array $data): void
    {
        $loggedIn = Auth::attempt($data, true);

        if (!$loggedIn) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
