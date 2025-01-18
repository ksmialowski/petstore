<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Services\FileUpload\FileUploadService;
use App\Services\Pet\Facades\Pet;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class PetController extends Controller
{
    CONST DEFAULT_STATUS = 'available';
    public function index()
    {
        $status = request('status');

        if (!in_array($status, ['available', 'pending', 'sold'])) {
            return redirect()->route('pets.index', ['status' => self::DEFAULT_STATUS]);
        }

        return view('pet.index', [
            'pets' => Pet::getPetsByStatus($status)
                ->map(fn(array $pet) => $this->petToObject($pet))
                ->paginate(8)
                ->appends([
                    'status' => $status
                ])
        ]);
    }

    public function create()
    {
        return view('pet.create');
    }

    /**
     * @throws ConnectionException
     */
    public function store(PetRequest $request)
    {
        $data = $request->safe()->except(['file']);
        $this->addImageToData($data, $request->file('file'));

        $petId = Pet::createPet($data);

        if ($petId) {
            return redirect()->route('pets.show', ['pet' => $petId])
                ->with('success', ['Pet created successfully']);
        }

        return redirect()->route('pets.create')
            ->with('danger', ['Failed to create pet']);
    }

    public function show(string $id)
    {
        /** @var Collection $pet */
        $pet = Pet::getPetById($id);

        if ($pet->isEmpty()) {
            abort(404);
        }

        return view('pet.show', [
            'pet' => $this->petToObject($pet)
        ]);
    }

    public function edit(string $id)
    {
        /** @var Collection $pet */
        $pet = Pet::getPetById($id);

        if ($pet->isEmpty()) {
            abort(404);
        }

        return view('pet.edit', [
            'pet' => $this->petToObject($pet)
        ]);
    }

    /**
     * @throws ConnectionException
     */
    public function update(PetRequest $request, string $id)
    {
        $data = $request->safe()->except(['file']);

        if ($file = $request->file('file')) {
            $this->addImageToData($data, $file);
        }

        $pet = Pet::updatePet($id, $data);

        if ($pet) {
            return redirect()->route('pets.show', ['pet' => $id])
                ->with('success', ['Pet updated successfully']);
        }

        return redirect()->route('pets.edit', ['pet' => $id])
            ->with('danger', ['Failed to update pet']);
    }

    public function destroy(string $id)
    {
        $pet = Pet::deletePet($id);

        if ($pet) {
            return redirect()->route('pets.index', ['status' => self::DEFAULT_STATUS])
                ->with('success', ['Pet deleted successfully']);
        }

        return redirect()->route('pets.show', ['pet' => $id])
            ->with('danger', ['Failed to delete pet']);
    }

    /**
     * @throws ConnectionException
     */
    private function addImageToData(array &$data, UploadedFile $file): void
    {
        $url = FileUploadService::upload($file);

        if ($url) {
            $data['photoUrls'] = [$url];
        }
    }

    private function petToObject($pet): object
    {
        return (object) [
            'id' => $pet['id'] ?? 0,
            'name' => $pet['name'] ?? null,
            'status' => $pet['status'] ?? null,
            'photo' => filter_var(\Arr::last($pet['photoUrls']) ?? null, FILTER_VALIDATE_URL),
        ];
    }
}
