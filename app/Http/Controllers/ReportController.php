<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // Income
        $income = \App\Models\Transaction::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->sum('paid_amount');

        // Patient Visits (Appointments)
        $visits = \App\Models\Appointment::whereBetween('appointment_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->count();

        // New Patients
        $newPatients = \App\Models\Patient::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->count();

        // Top Services
        $topServices = \App\Models\TransactionDetail::select('item_name', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('item_name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('reports.index', compact('income', 'visits', 'newPatients', 'topServices', 'startDate', 'endDate'));
    }
}
