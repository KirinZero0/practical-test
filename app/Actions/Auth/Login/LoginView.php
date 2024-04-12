<?php

namespace App\Actions\Auth\Login;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginView
{
    use AsAction;

    public function handle(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function asController()
    {
        return $this->handle();
    }
}