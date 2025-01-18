<?php

namespace App\Services\Pet\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PetRepository implements PetInterface
{
    private PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::baseUrl(config('url.pet_base_url', ''))->acceptJson();
    }

    /**
     * @throws ConnectionException
     */
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

    /**
     * @throws ConnectionException
     */
    public function createPet(array $data): int
    {
        $response = $this->http->post('v2/pet/', $data);
        return $response->json()['id'] ?? 0;
    }

    /**
     * @throws ConnectionException
     */
    public function updatePet(string $id, array $data): bool
    {
        $data['id'] = $id;
        $response = $this->http->put('v2/pet/', $data);
        return $response->successful();
    }

    /**
     * @throws ConnectionException
     */
    public function deletePet(string $id): bool
    {
        $response = $this->http->delete('v2/pet/' . $id);
        return $response->successful();
    }

    /*public function uploadImage(string $id, UploadedFile $file): bool
    {
        $response = $this->http
            ->attach('file', $file->getContent(), $file->hashName(), ['Content-Type' => 'multipart/form-data'])
            ->post('v2/pet/' . $id . '/uploadImage');

        return $response->successful();
    }*/
}
