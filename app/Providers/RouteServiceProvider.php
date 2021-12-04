<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::group(['as' => 'auth.', 'prefix' => 'auth'], base_path('routes/auth.php'));
            Route::group(['as' => 'main.', 'middleware' => ['api']], base_path('routes/main.php'));
            Route::group(['as' => 'profile.', 'prefix' => 'profile', 'middleware' => ['api', 'auth:api']], base_path('routes/profile.php'));
        });
    }
}
