<?php

namespace App\Actions\Confirmation\Password;

use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class ConfirmationView
{
    use AsAction;

    public function handle()
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    public function asController()
    {
        return $this->handle();
    }
}