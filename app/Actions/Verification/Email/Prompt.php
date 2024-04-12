<?php

namespace App\Actions\Verification\Email;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class Prompt 
{
    use AsAction;

    public function handle(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }

    public function asController(Request $request): RedirectResponse|Response
    {
        return $this->handle($request);
    }
}