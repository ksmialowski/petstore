<?php

namespace App\Http\Controllers;

use App\Services\Pet\Facades\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PetController extends Controller
{
    public function index()
    {
        $status = request('status');

        if (!in_array($status, ['available', 'pending', 'sold'])) {
            return redirect()->route('pets.index', ['status' => 'available']);
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
        //
    }

    public function store(Request $request)
    {
        //
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
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
