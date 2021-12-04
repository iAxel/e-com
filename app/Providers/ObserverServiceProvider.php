<?php

namespace App\Providers;

use App\Models\Token;

use App\Observers\TokenObserver;

use Illuminate\Support\ServiceProvider;

final class ObserverServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerObservers();
    }

    /**
     * @return void
     */
    private function registerObservers(): void
    {
        Token::observe(TokenObserver::class);
    }
}
