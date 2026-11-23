# Laravel Social Authentication

Laravel 13 / Socialite patterns for Google, Facebook, X, and Pinterest OAuth. The controller allowlists providers, redirects through Socialite, and delegates account linking to a dedicated service.

Register provider client IDs, client secrets, and callback URLs in `config/services.php` via environment variables. Never commit OAuth credentials.

```php
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);
```

Community Socialite providers may be required for X and Pinterest.
