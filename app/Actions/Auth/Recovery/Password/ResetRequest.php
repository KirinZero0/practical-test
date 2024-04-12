<?php

namespace App\Actions\Recovery\Password;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ResetRequest
{
    use AsAction;

    public function handle()
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    public function asController(): Response
    {
        return $this->handle();
    }
}