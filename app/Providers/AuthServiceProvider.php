<?php

namespace App\Providers;

use App\Modules\Olympus;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerGuard();
    }

    /**
     * @return void
     */
    private function registerGuard(): void
    {
        Auth::extend('olympus', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider']);

            $guard = new Olympus($app['request'], $provider);

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }
}
