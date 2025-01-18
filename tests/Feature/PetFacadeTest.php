<?php

namespace Tests\Feature;

use App\Services\Pet\Facades\Pet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PetFacadeTest extends TestCase
{
    public function test_get_pet_by_id_returns_collection_on_successful_request()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/1' => Http::response([
                'id' => 1,
                'name' => 'Dog',
                'status' => 'available'
            ]),
        ]);

        $result = Pet::getPetById('1');

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertFalse($result->isEmpty());
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Dog', $result['name']);
        $this->assertEquals('available', $result['status']);
    }

    public function test_get_pet_by_id_returns_empty_collection_on_failed_request()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/1' => Http::response([], 404),
        ]);

        $result = Pet::getPetById('1');

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue($result->isEmpty());
    }

    public function test_update_pet_returns_true_on_successful_request()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/' => Http::response([], 200),
        ]);

        /** @var bool $result */
        $result = Pet::updatePet('1', [
            'name' => 'Updated Dog',
            'status' => 'sold'
        ]);

        $this->assertTrue($result);
    }

    public function test_update_pet_returns_false_on_failed_request()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/' => Http::response([], 500),
        ]);

        $result = Pet::updatePet('1', [
            'name' => 'Updated Dog',
            'status' => 'sold'
        ]);

        $this->assertFalse($result);
    }

    public function test_delete_pet_returns_true_on_successful_request()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/1' => Http::response([], 200),
        ]);

        /** @var bool $result */
        $result = Pet::deletePet('1');

        $this->assertTrue($result);
    }

    public function test_delete_pet_returns_false_on_failed_request()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/1' => Http::response([], 404),
        ]);

        $result = Pet::deletePet('1');

        $this->assertFalse($result);
    }
}
