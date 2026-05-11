<?php

namespace App\Providers;

use App\Repositories\Auth\UserRepository;
use App\Repositories\Auth\IUserRepository;
use App\Repositories\Ticket\ITicketRepository;
use App\Repositories\Ticket\TicketRepository;
use App\Services\Auth\AuthService;
use App\Services\Auth\Contracts\IAuthService;
use App\Services\Ticket\Contracts\ITicketService;
use App\Services\Ticket\TicketService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ITicketService::class, TicketService::class);
        $this->app->bind(ITicketRepository::class, TicketRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
