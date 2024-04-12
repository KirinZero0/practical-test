<?php

namespace App\Actions\Auth\Register;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterView
{
    use AsAction;

    public function handle(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function asController()
    {
        return $this->handle();
    }
}