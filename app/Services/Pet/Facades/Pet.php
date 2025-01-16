<?php

namespace App\Services\Pet\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\Pet\Repositories\PetRepository;

class Pet extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PetRepository::class;
    }
}
