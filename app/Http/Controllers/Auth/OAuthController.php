<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectToProvider(Request $request, $provider)
    {
        // Validate the provider
        if (!config('services.' . $provider)) {
            return response()->json(['error' => 'Invalid provider'], 400);
        }
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            // Handle the user information as needed
            return response()->json($user);
        } catch (\Exception $e) {
            if ($e->getMessage()) {
                return response()->json(['error' => $e->getMessage()], $e->getCode());
            }
            return response()->json(['error' => 'Failed to authenticate with ' . $provider], 500);
        }
    }
}
