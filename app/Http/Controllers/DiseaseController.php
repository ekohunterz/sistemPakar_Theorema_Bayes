<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiseaseRequest;
use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DiseaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Disease::query()->when($request->get('search'), function ($query, $search) {
            return $query->whereAny([
                'name',
                'description',
                'solution',
            ], 'like', '%' . $search . '%');
        });

        $diseases = $query->paginate($request->get('limit', 10));

        return Inertia::render('Diseases/Index', [
            'diseases' => $diseases,
            'filters' => $request->only(['search', 'sort', 'limit']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Diseases/Create');
    }

    public function store(DiseaseRequest $request)
    {
        $disease = Disease::create([
            'name' => $request->name,
            'description' => $request->description,
            'solution' => $request->solution,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/diseases', $image->hashName());
            $disease->update(['image' => $image->hashName()]);
        }


        return redirect()->route('diseases.index')->with('message', 'Disease created successfully');
    }


    public function edit(Disease $disease)
    {
        return Inertia::render('Diseases/Edit', [
            'disease' => $disease
        ]);
    }

    public function update(DiseaseRequest $request, Disease $disease)
    {

        $disease->update([
            'name' => $request->name,
            'description' => $request->description,
            'solution' => $request->solution,
        ]);

        if ($request->hasFile('image')) {
            if ($disease->image) {
                Storage::delete('public/diseases/' . basename($disease->image));
            }
            $image = $request->file('image');
            $image->storeAs('public/diseases', $image->hashName());
            $disease->image = $image->hashName();
        }

        $disease->save();

        return redirect()->route('diseases.index')->with('message', 'Disease updated successfully');
    }



    public function destroy(Disease $disease)
    {
        if ($disease->image) {
            Storage::delete('public/diseases/' . basename($disease->image));
        }
        $disease->delete();
        return redirect()->route('diseases.index')->with('message', 'Disease deleted successfully');
    }
}
