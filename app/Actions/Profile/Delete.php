<?php

namespace App\Actions\Profile;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Lorisleiva\Actions\Concerns\AsAction;

class Delete
{
    use AsAction;

    public function handle(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function asController(Request $request): RedirectResponse
    {
        $this->handle($request);
        
        return Redirect::to('/');
    }
}