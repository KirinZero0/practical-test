<?php

namespace App\Actions\Recovery\Password;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ResetForm
{
    use AsAction;

    public function handle(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function asController(Request $request): Response
    {
        return $this->handle($request);
    }
}