<?php

namespace App\Actions\Verification\Email;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class Verify
{
    use AsAction;

    public function handle(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
    }

    public function asController(Request $request): RedirectResponse
    {
        return $this->handle($request);
        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}