<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Rule $rule)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($disease_id)
    {
        $disease = Disease::where('id', $disease_id)->firstOrFail();
        $symptoms = Symptom::all();
        $rules = Rule::where('disease_id', $disease_id)->get();
        return Inertia::render('Diseases/Rules', [
            'disease' => $disease,
            'rules' => $rules,
            'symptoms' => $symptoms
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $disease_id)
    {

        $request->validate([
            'weight' => 'required|array|min:3',
        ]);


        // Hapus semua aturan terkait kode penyakit yang diberikan
        Rule::where('disease_id', $disease_id)->delete();

        $weight = $request->weight;

        foreach ($weight as $key => $value) {
            // Pastikan nilai probabilitas tidak sama dengan 0 sebelum membuat aturan
            if ($value['checked'] != false) {
                Rule::create([
                    'disease_id' => $disease_id,
                    'symptom_id' => $value['id'],
                    'weight' => $value['weight'],
                ]);
            }
        }

        return redirect()->route('diseases.index')->with('message', 'Rule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule)
    {
    }
}
