<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ResultController extends Controller
{

    protected $ConsultController;

    public function __construct()
    {

        $this->ConsultController = new ConsultController();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Result::query()->with('disease')->when($request->get('search'), function ($query, $search) {
            return $query->whereAny([
                'name',
                'phone',
                'selected_symptoms',
                'result',
            ], 'like', '%' . $search . '%')->orWhereHas('disease', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })->when($request->has('month'), function ($query) use ($request) {
            $query->whereMonth('created_at', $request->get('month') + 1);
        })->when($request->has('year'), function ($query) use ($request) {
            $query->whereYear('created_at', $request->get('year'));
        });


        $results = $query->paginate($request->get('limit', 10));

        return Inertia::render(
            'Results/Index',
            [
                'results' => $results,
                'filters' => $request->only(['search', 'month', 'year']),
            ]
        );
    }

    public function show(Result $result)
    {
        $selected_symptoms = explode(', ', $result->selected_symptoms);

        $view = [
            'result' => $result,
        ]
            + $this->ConsultController->proccess($selected_symptoms);

        return Inertia::render(
            'Results/Show',
            $view
        );
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return redirect()->back()->with('message', 'Result deleted successfully');
    }

    public function pdf(Request $request)
    {

        $results = Result::with('disease')
            ->whereMonth('created_at', $request->get('month') + 1)
            ->whereYear('created_at', $request->get('year'))
            ->get();
        $pdf = Pdf::loadView('Export.Case', [
            'results' => $results
        ]);
        return $pdf->download('results.pdf');
    }


    public function export_result(Result $result)
    {

        $selected_symptoms = explode(', ', $result->selected_symptoms);
        $data = $this->ConsultController->proccess($selected_symptoms);

        $pdf = Pdf::loadView('Export.Result', [
            'result' => $result,
        ] + $data);
        return $pdf->download('Case Report' . $result->id . '-' . $result->name . '.pdf');
    }
}
