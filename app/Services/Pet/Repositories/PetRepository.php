<?php

namespace App\Services\Pet\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class PetRepository implements PetInterface
{
    private PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::baseUrl('https://petstore.swagger.io')->acceptJson();
    }

    public function getPetsByStatus(string $status): Collection
    {
        $response = $this->http->get('v2/pet/findByStatus', ['status' => $status]);

        if (!$response->successful()) {
            return collect([]);
        }

        return collect($response->json());
    }

    public function getPetById(string $id): Collection
    {
        $response = $this->http->get('v2/pet/' . $id);

        if (!$response->successful()) {
            return collect([]);
        }

        return collect($response->json());
    }

    public function createPet(array $data): bool
    {
        $response = $this->http->post('v2/pet/', $data);
        return $response->successful();
    }

    public function updatePet(string $id, array $data): bool
    {
        $response = $this->http->asForm()->post('v2/pet/' . $id, $data);
        return $response->successful();
    }

    public function deletePet(string $id): bool
    {
        $response = $this->http->delete('v2/pet/' . $id);
        return $response->successful();
    }

    public function uploadImage(string $id, string $file): bool
    {
        $response = $this->http
            ->attach('file', file_get_contents($file), 'image.jpg', ['Content-Type' => 'multipart/form-data'])
            ->post('v2/pet/' . $id . '/uploadImage');
        return $response->successful();
    }
}
