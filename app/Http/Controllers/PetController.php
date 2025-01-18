<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Services\Pet\Facades\Pet;
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

    public function store(PetRequest $request)
    {
        $pet = Pet::createPet($request->validated());

        if ($pet) {
            return redirect()->route('pets.index', ['status' => $request->status])
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

        return view('pet.show', compact('pet'));
    }

    public function edit(string $id)
    {
        /** @var Collection $pet */
        $pet = Pet::getPetById($id);

        if ($pet->isEmpty()) {
            abort(404);
        }

        return view('pet.edit', compact('pet'));
    }

    public function update(PetRequest $request, string $id)
    {
        $pet = Pet::updatePet($id, $request->validated());

        if ($pet) {
            return redirect()->route('pets.edit', ['pet' => $id])
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

        return redirect()->route('pets.index')
            ->with('danger', ['Failed to delete pet']);
    }
}
