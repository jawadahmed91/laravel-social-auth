# Laravel Social Authentication


Laravel 13 / Socialite patterns for Google, Facebook, X, and Pinterest OAuth. The controller allowlists providers, redirects through Socialite, and delegates account linking to a dedicated service.


Register provider client IDs, client secrets, and callback URLs in `config/services.php` via environment variables. Never commit OAuth credentials.


```php
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);
```


Community Socialite providers may be required for X and Pinterest.

## Add this to an existing Laravel project

1. Install Socialite with `composer require laravel/socialite` and install the appropriate SocialiteProviders adapters for providers not supported by the core package.
2. Create OAuth applications with Google, Facebook, X, or Pinterest and register an exact callback URL for each environment.
3. Add each client ID, client secret, and redirect URL to `.env`, then map them in `config/services.php`.
4. Copy `SocialAuthController.php` to `app/Http/Controllers/Auth/` and change its namespace and imports.
5. Implement `SocialUserLinker` in your application. Match an existing provider link first, safely link a verified email according to your account policy, or create a user and provider-link record inside a transaction.
6. Bind `SocialUserLinker` to that implementation in a service provider.
7. Add the redirect and callback routes shown above. Apply the `guest` middleware and rate limiting appropriate for your application.
8. Keep Socialite's state verification enabled for normal browser login flows. Use `stateless()` only for an architecture that provides another verified anti-forgery mechanism.
9. Store the provider name and provider user ID. Encrypt provider tokens if your application must retain them, request only required scopes, and support token revocation.
10. Copy `tests/SocialAuthControllerTest.php` into your project, update its namespace and imports, and run `php artisan test` with Socialite mocked.
11. Test provider allowlisting, redirect, callback, existing-account linking, new-account creation, duplicate email policy, revoked consent, and provider error responses.
