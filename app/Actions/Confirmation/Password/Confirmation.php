<?php

namespace App\Actions\Confirmation\Password;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class Confirmation
{
    use AsAction;

    public function handle(Request  $request)
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());
    }

    public function asController(Request $request): RedirectResponse
    {
        $this->handle($request);
        return redirect()->intended(route('dashboard', absolute: false));
    }
}