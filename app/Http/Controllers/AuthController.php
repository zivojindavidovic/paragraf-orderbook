<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthUser;
use App\Services\UserPersistence;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AuthController extends Controller
{
    private UserPersistence $userPersistence;
    private AuthUser $authUser;

    public function __construct(UserPersistence $userPersistence, AuthUser $authUser)
    {
        $this->userPersistence = $userPersistence;
        $this->authUser = $authUser;
    }

    public function getRegister(): View|Application|Factory
    {
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request): View|Application|Factory
    {
        $data = $request->validated();
        $this->userPersistence->registerUser($data);

        return view('auth.login');
    }

    public function getLogin(): View|Application|Factory
    {
        return view('auth.login');
    }

    public function login(LoginRequest $loginRequest): Application|Redirector|RedirectResponse
    {
        $data = $loginRequest->validated();
        $this->authUser->login($data);

        return redirect('/');
    }

    public function logout(): Application|Redirector|RedirectResponse
    {
        $this->authUser->logout();
        return redirect('/login');
    }
}
