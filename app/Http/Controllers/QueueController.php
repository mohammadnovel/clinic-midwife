<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class QueueController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'visit_date' => 'required|date|after_or_equal:today',
            'service' => 'required|string',
            'dob' => 'nullable|date', // Optional on front, default if missing? Or make required.
        ]);

        // 1. Find or Create Patient
        // Simple check: Name + Phone match
        $patient = \App\Models\Patient::where('name', $request->name)
            ->where('phone', $request->phone)
            ->first();

        if (!$patient) {
            // Create new temporary patient
            // Note: DOB is required in DB. If not provided, we might need a fallback or ask user.
            // For now, let's require DOB in the form to be safe.
            if (!$request->dob) {
                return back()->with('error', 'Tanggal Lahir diperlukan untuk pendaftaran baru.');
            }

            $patient = \App\Models\Patient::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'date_of_birth' => $request->dob,
                'address' => 'Pendaftaran Online',
                'user_id' => null, // Guest
            ]);
        }

        // 2. Generate Queue Number
        // Format: YYYYMMDD-001 or just 001 reset daily?
        // Let's use simple daily counter: A-001
        $date = Carbon::parse($request->visit_date);
        $count = Appointment::whereDate('appointment_date', $date->format('Y-m-d'))->count();
        $queueNumber = 'A-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // 3. Create Appointment
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'midwife_id' => null, // Unassigned
            'queue_number' => $queueNumber,
            'appointment_date' => $date->setTime(9, 0), // Default to morning? Or just date. 
            // DB says 'dateTime'. Let's set it to date + 08:00
            'service_category' => $request->service,
            'status' => 'pending',
            'notes' => 'Pendaftaran via Website',
        ]);

        return redirect()->back()->with('success', "Pendaftaran Berhasil! Nomor Antrian Anda: $queueNumber");
    }
}
