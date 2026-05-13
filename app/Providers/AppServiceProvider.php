<?php

namespace App\Providers;
use App\Models\Post;
use App\Observers\PostObserver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Failed;
use App\Models\AuditLog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    Post::observe(PostObserver::class);

    \Illuminate\Support\Facades\Event::listen(Login::class, function (Login $event) {
        AuditLog::create([
            'user_id' => $event->user->id,
            'action' => 'login',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    });

    \Illuminate\Support\Facades\Event::listen(Logout::class, function (Logout $event) {
        AuditLog::create([
            'user_id' => $event->user?->id,
            'action' => 'logout',
            'ip_address' => request()->ip(),
        ]);
    });

    \Illuminate\Support\Facades\Event::listen(Failed::class, function (Failed $event) {
        AuditLog::create([
            'user_id' => null,
            'action' => 'failed_login',
            'new_values' => ['email' => $event->credentials['email'] ?? 'unknown'],
            'ip_address' => request()->ip(),
        ]);
    });
}
}
