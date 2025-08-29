<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class ProviderRedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $provider)
    {
        if (!in_array($provider, ['github', 'google'])) {
            return redirect(route('login'))->withErrors(['provider' => 'Invalid Provider']);
        }

        try {
            return Socialite::driver($provider)->redirect();
        } catch (Exception $err) {
            return redirect(route('login'))->withErrors(['provider' => 'Something went wrong']);
        }
    }
}
