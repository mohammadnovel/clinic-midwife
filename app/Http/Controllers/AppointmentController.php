<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = \App\Models\Appointment::with(['patient', 'midwife'])->latest('appointment_date')->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = \App\Models\Patient::all();
        $midwives = \App\Models\Midwife::with('user')->get();
        return view('appointments.create', compact('patients', 'midwives'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'midwife_id' => 'required|exists:midwives,id',
            'appointment_date' => 'required|date',
            'service_category' => 'required|string',
        ]);

        // Generate Queue Number (Simple logic: A-001, separate by day usually, but keeping simple)
        $todayCount = \App\Models\Appointment::whereDate('appointment_date', \Carbon\Carbon::parse($data['appointment_date']))->count();
        $queueNumber = 'A-' . str_pad($todayCount + 1, 3, '0', STR_PAD_LEFT);

        \App\Models\Appointment::create([
            'patient_id' => $data['patient_id'],
            'midwife_id' => $data['midwife_id'],
            'appointment_date' => $data['appointment_date'],
            'service_category' => $data['service_category'],
            'queue_number' => $queueNumber,
            'status' => 'pending'
        ]);

        return redirect()->route('appointments.index')->with('success', 'Antrian berhasil dibuat. Nomor: ' . $queueNumber);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
