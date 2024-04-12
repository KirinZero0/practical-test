<?php

namespace App\Actions\Verification\Email;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class Notification
{
    use AsAction;

    public function handle(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();
    }

    public function asController(Request $request): RedirectResponse
    {
        $this->handle($request);
        return back()->with('status', 'verification-link-sent');
    }
}