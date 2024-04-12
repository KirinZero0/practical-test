<?php

namespace  App\Actions\Profile\Password;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Lorisleiva\Actions\Concerns\AsAction;

class Update 
{
    use AsAction;

    public function handle(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
    }

    public function asController(Request $request): RedirectResponse
    {
        $this->handle($request);

        return back();
    }
}