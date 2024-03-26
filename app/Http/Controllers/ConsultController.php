<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Result;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConsultController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symptoms = Symptom::all();
        return Inertia::render(
            'Consults/Index',
            [
                'symptoms' => $symptoms
            ]
        );
    }

    public function diagnose(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $selectedSymptoms = $request->input('selectedSymptoms');

        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'selectedSymptoms' => 'required|array|min:3',
        ]);

        $result = $this->proccess($selectedSymptoms);

        $result['name'] = $name;
        $result['phone'] = $phone;

        return Inertia::render('Consults/Result', $result);
    }

    public function proccess($selectedSymptoms)
    {
        $getSelectedSymptoms = Symptom::whereIn('id', $selectedSymptoms)->get()->keyBy('id');

        if ($getSelectedSymptoms->isEmpty()) {
            return redirect()->route('consults.index')->with('message', 'No matching symptoms found');
        }

        $relatedDiseases = Rule::whereIn('symptom_id', $selectedSymptoms)
            ->groupBy('disease_id')
            ->pluck('disease_id');

        // Mengambil nama penyakit yang terkait dari tabel Penyakit
        $relatedDiseaseNames = Disease::whereIn('id', $relatedDiseases)->get(['id', 'name'])->keyBy('id');

        $relatedSymptoms = [];
        foreach ($relatedDiseases as $disease_id) {
            $relatedSymptoms[$disease_id] = Rule::select('disease_id', 'symptom_id', 'weight')
                ->where('disease_id', $disease_id)
                ->whereIn('symptom_id', $selectedSymptoms)
                ->get();
        }

        //SUM PROBABILITY OF EACH SYMPTOM
        $totalProbabilities = [];

        foreach ($relatedSymptoms as $disease_id => $symptoms) {
            $totalProbability = 0;

            foreach ($symptoms as $symptom) {
                $totalProbability += $symptom->weight;
            }

            $totalProbabilities[$disease_id] = $totalProbability;
        }

        //DIVIDE PROBABILITY OF EACH SYMPTOM BY TOTAL PROBABILITY
        $totalProbabilities_H = [];
        foreach ($relatedSymptoms as $disease_id => $symptoms) {
            $totalProbH = 0;

            foreach ($symptoms as  $symptom) {
                $totalProbH = $symptom->weight / $totalProbabilities[$disease_id];
                $totalProbabilities_H[$disease_id][$symptom->symptom_id] = $totalProbH;
            }
        }

        $totalProbabilitiesE = [];
        foreach ($relatedSymptoms as $disease_id => $symptoms) {
            $totalProbE = 0;

            foreach ($symptoms as  $symptom) {
                $ProbE = $symptom->weight * $totalProbabilities_H[$disease_id][$symptom->symptom_id];
                $totalProbE += $ProbE;
            }

            $totalProbabilitiesE[$disease_id] = $totalProbE;
        }

        $totalProbabilitiesHE = [];

        foreach ($relatedSymptoms as $disease_id => $symptoms) {
            foreach ($symptoms as $symptom) {
                $totalProbabilitiesHE[$disease_id][$symptom->symptom_id] = ($symptom->weight * $totalProbabilities_H[$disease_id][$symptom->symptom_id]) / $totalProbabilitiesE[$disease_id];
            }
        }

        $totalBayes = [];

        foreach ($relatedSymptoms as $disease_id => $symptoms) {
            $result = 0;
            // Temukan nama penyakit berdasarkan kode penyakit
            $disease = Disease::where('id', $disease_id)->first();
            foreach ($symptoms as $symptom) {
                $total = $symptom->weight * $totalProbabilitiesHE[$disease_id][$symptom->symptom_id];
                $result += $total;
            }

            // Simpan hasil bersama dengan nama penyakit
            $totalBayes[$disease_id] = [
                'id' => $disease_id,
                'name' => $disease->name,
                'solution' => $disease->solution,
                'result' => $result,
            ];
            usort($totalBayes, function ($a, $b) {
                // Urutkan dari yang terbesar ke yang terkecil berdasarkan nilai 'result'
                return $b['result'] <=> $a['result'];
            });
        }

        return [
            'selectedSymptoms' => $getSelectedSymptoms,
            'relatedDiseases' => $relatedDiseaseNames,
            'relatedSymptoms' => $relatedSymptoms,
            'totalProbability' => $totalProbabilities,
            'totalProbabilities_H' => $totalProbabilities_H,
            'totalProbE' => $totalProbabilitiesE,
            'totalProbabilitiesHE' => $totalProbabilitiesHE,
            'totalBayes' => $totalBayes
        ];
    }

    public function store(Request $request)
    {
        $selectedSymptomsString = implode(', ', $request->selected_symptoms);

        $consult = Result::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'selected_symptoms' => $selectedSymptomsString,
            'disease_id' => $request->disease_id,
            'result' => $request->result
        ]);
        return redirect()->route('results.index')->with('message', 'Diagnose result saved successfully.');
    }
}
