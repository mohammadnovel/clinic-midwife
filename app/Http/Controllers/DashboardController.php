<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Appointment; // Was Visit, now Appointment. Wait, schema uses 'appointments'.

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Using simplified check tailored for Admin for this demo, 
        // as other roles might need their own distinct logic or shared layout.

        $stats = [];
        if ($user->hasRole('admin') || $user->hasRole('bidan')) {
            $stats = [
                'patients' => Patient::count(),
                'visits_today' => Appointment::whereDate('appointment_date', today())->count(),
                'pending_queue' => Appointment::whereDate('appointment_date', today())->where('status', 'pending')->count(),
            ];

            // Reusing admin view for Bidan for now as they share similar dashboard needs in this TailAdmin setup
            return view('dashboard.admin', compact('stats'));
        }

        // Pharmacy
        if ($user->hasRole('pharmacy')) {
            return view('dashboard.pharmacy');
        }

        // Patient
        if ($user->hasRole('patient')) {
            return view('dashboard.patient');
        }

        return view('dashboard');
    }
}
