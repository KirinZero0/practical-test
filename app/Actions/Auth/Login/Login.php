<?php

namespace App\Actions\Auth\Login;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class Login
{
    use AsAction;

    public function handle($request)
    {
        $request->authenticate();

        $request->session()->regenerate();
    }

    public function asController(LoginRequest $request): RedirectResponse
    {
        $this->handle($request);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}