<?php

namespace App\Services\Pet\Repositories;

use Illuminate\Support\Collection;

interface PetInterface
{
    public function getPetsByStatus(string $status): Collection;
    public function getPetById(string $id): Collection;
    public function createPet(array $data): bool;
    public function updatePet(string $id, array $data): bool;
    public function deletePet(string $id): bool;
    public function uploadImage(string $id, string $file): bool;
}
