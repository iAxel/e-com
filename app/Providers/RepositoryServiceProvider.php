<?php

namespace App\Providers;

use App\Http\Repositories\Auth\LoginRepository as AuthLoginRepository;
use App\Http\Repositories\Auth\LogoutRepository as AuthLogoutRepository;

use App\Http\Repositories\Auth\Contracts\LoginRepository as AuthLoginRepositoryContract;
use App\Http\Repositories\Auth\Contracts\LogoutRepository as AuthLogoutRepositoryContract;

use App\Http\Repositories\Main\UserRepository as MainUserRepository;
use App\Http\Repositories\Main\ClientRepository as MainClientRepository;

use App\Http\Repositories\Main\Contracts\UserRepository as MainUserRepositoryContract;
use App\Http\Repositories\Main\Contracts\ClientRepository as MainClientRepositoryContract;

use App\Http\Repositories\Profile\Repository as ProfileRepository;
use App\Http\Repositories\Profile\SessionRepository as ProfileSessionRepository;

use App\Http\Repositories\Profile\Contracts\Repository as ProfileRepositoryContract;
use App\Http\Repositories\Profile\Contracts\SessionRepository as ProfileSessionRepositoryContract;

use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected array $repositories = [
        AuthLoginRepository::class => AuthLoginRepositoryContract::class,
        AuthLogoutRepository::class => AuthLogoutRepositoryContract::class,

        MainUserRepository::class => MainUserRepositoryContract::class,
        MainClientRepository::class => MainClientRepositoryContract::class,

        ProfileRepository::class => ProfileRepositoryContract::class,
        ProfileSessionRepository::class => ProfileSessionRepositoryContract::class,
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerRepositories();
    }

    /**
     * @return void
     */
    private function registerRepositories(): void
    {
        foreach ($this->repositories as $concrete => $abstract) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
