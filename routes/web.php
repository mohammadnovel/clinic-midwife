<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MidwifeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PregnancyController;
use App\Http\Controllers\AncVisitController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\BabyController;
use App\Http\Controllers\PncVisitController;
use App\Http\Controllers\FamilyPlanningController;
use App\Http\Controllers\ImmunizationRecordController;
use App\Http\Controllers\WebsiteContentController;
use App\Http\Controllers\ReferralController;
use Illuminate\Support\Facades\Route;

use App\Models\Service;
use App\Models\WebsiteContent;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/queue', [QueueController::class, 'index'])->name('queue.display');
Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('midwives', MidwifeController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('medicines', MedicineController::class);

    // Clinical / Medical Records
    Route::resource('appointments', AppointmentController::class);
    Route::resource('medical-records', MedicalRecordController::class);
    Route::resource('pregnancies', PregnancyController::class);
    Route::resource('anc-visits', AncVisitController::class);
    Route::resource('deliveries', DeliveryController::class);
    Route::resource('babies', BabyController::class);
    Route::resource('pnc-visits', PncVisitController::class);
    Route::resource('family-plannings', FamilyPlanningController::class);
    Route::resource('immunizations', ImmunizationRecordController::class);

    // Finance, Referrals & CMS
    Route::resource('transactions', TransactionController::class);
    Route::resource('referrals', ReferralController::class);
    Route::resource('website-contents', WebsiteContentController::class);

    // Reports
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
