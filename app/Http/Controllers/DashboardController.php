<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Result;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $diseasesCount = Disease::count();
        $symptomsCount = Symptom::count();
        $resultsCount = Result::count();

        $caseResults = Result::leftJoin('diseases', 'results.disease_id', '=', 'diseases.id')
            ->select('results.disease_id', 'diseases.name', DB::raw('count(*) as total'))
            ->groupBy('results.disease_id', 'diseases.name')
            ->pluck('total', 'name');


        return Inertia::render('Dashboard', [
            'diseasesCount' => $diseasesCount,
            'symptomsCount' => $symptomsCount,
            'resultsCount' => $resultsCount,
            'caseResults' => $caseResults
        ]);
    }
}
