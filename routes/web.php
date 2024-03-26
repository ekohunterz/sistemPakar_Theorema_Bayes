<?php

use App\Http\Controllers\ConsultController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SymptomController;
use App\Models\Disease;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'diseases' => Disease::all(),
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('symptoms', SymptomController::class);
    Route::resource('diseases', DiseaseController::class)->except('show');
    Route::get('diseases/{disease}/rules', [RuleController::class, 'edit'])->name('diseases.show');
    Route::post('diseases/{disease}/rules', [RuleController::class, 'update'])->name('diseases.rules');
    Route::get('consults', [ConsultController::class, 'index'])->name('consults.index');
    Route::post('consults/diagnose', [ConsultController::class, 'diagnose'])->name('consults.diagnose');
    Route::post('consults', [ConsultController::class, 'store'])->name('consults.store');
    Route::resource('results', ResultController::class)->only(['index', 'show', 'destroy']);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('pdf', [ResultController::class, 'pdf'])->name('pdf');
    Route::get('pdf/{result}', [ResultController::class, 'export_result'])->name('pdf.export');
});

require __DIR__ . '/auth.php';
