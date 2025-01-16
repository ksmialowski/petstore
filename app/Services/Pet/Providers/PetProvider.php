<?php

namespace App\Services\Pet\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Pet\Repositories\PetRepository;
use App\Services\Pet\Repositories\PetInterface;

class PetProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        match ($this->app->environment()) {
            default => $this->app->bind(PetInterface::class, PetRepository::class),
        };
    }
}
