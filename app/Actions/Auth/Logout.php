<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class Logout 
{
    use AsAction;

    public function handle($request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    public function asController(Request $request)
    {
        $this->handle($request);

        return redirect('/');
    }

}