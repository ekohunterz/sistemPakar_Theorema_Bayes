<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Http\Requests\SymptomRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Symptom::query()->when($request->get('search'), function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });

        $symptoms = $query->paginate($request->get('limit', 10));

        return Inertia::render('Symptoms/Index', [
            'symptoms' => $symptoms,
            'filters' => $request->only(['search', 'sort', 'limit']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Symptoms/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SymptomRequest $request)
    {
        $symptom = Symptom::create($request->all());
        return redirect()->route('symptoms.index')->with('message', 'Symptom created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        return Inertia::render('Symptoms/Edit', [
            'symptom' => $symptom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SymptomRequest $request, Symptom $symptom)
    {
        $symptom->update($request->only('name'));
        return redirect()->route('symptoms.index')->with('message', 'Symptom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return redirect()->route('symptoms.index')->with('message', 'Symptom deleted successfully');
    }
}
