<?php

namespace JawadAhmed\SocialAuth;

use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

final class SocialAuthController
{
    private const PROVIDERS = ['google', 'facebook', 'x', 'pinterest'];

    public function __construct(private readonly SocialUserLinker $linker) {}

    public function redirect(string $provider): SymfonyRedirectResponse
    {
        $this->assertProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        $this->assertProvider($provider);
        $socialUser = Socialite::driver($provider)->user();
        $user = $this->linker->link($provider, $socialUser);
        auth()->login($user, true);
        return redirect()->intended('/dashboard');
    }

    private function assertProvider(string $provider): void
    {
        abort_unless(in_array($provider, self::PROVIDERS, true), 404);
    }
}

interface SocialUserLinker
{
    public function link(string $provider, object $socialUser): object;
}
