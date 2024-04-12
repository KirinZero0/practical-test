<?php

namespace App\Actions\Profile;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Lorisleiva\Actions\Concerns\AsAction;

class Update
{
    use AsAction;

    public function handle($request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
    }

    public function asController(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->handle($request);

        return Redirect::route('profile.edit');
    }
}