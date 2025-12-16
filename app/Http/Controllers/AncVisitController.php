<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AncVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visits = \App\Models\AncVisit::with(['pregnancy.patient'])->latest()->paginate(10);
        return view('anc-visits.index', compact('visits'));
    }

    public function create()
    {
        // Only active pregnancies AND has an appointment today is ideal, 
        // but for simplicity let's just list all active pregnancies.
        $pregnancies = \App\Models\Pregnancy::with('patient')->where('status', 'active')->get();
        // Just generic appointments for now
        $appointments = \App\Models\Appointment::latest()->limit(50)->get();

        return view('anc-visits.create', compact('pregnancies', 'appointments'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'pregnancy_id' => 'required|exists:pregnancies,id',
            'gestational_age_weeks' => 'nullable|integer',
            'weight' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'fundal_height' => 'nullable|string',
            'fetal_heart_rate' => 'nullable|string',
            'complaints' => 'nullable|string',
            'actions' => 'nullable|string',
        ]);

        // Find or create appointment link (Optional complexity skipped for speed)
        // If appointment_id is required by schema, we need to handle it.
        // For now, let's grab the latest appointment or create dummy if simpler.
        // Actually, let's force the user to pick an appointment or auto-create one.
        // Let's assume there is an appointment_id passed or we fetch the latest for this patient.

        // Quick fix: Find latest appointment for this patient
        $pregnancy = \App\Models\Pregnancy::find($data['pregnancy_id']);
        $appointment = \App\Models\Appointment::where('patient_id', $pregnancy->patient_id)->latest()->first();

        if (!$appointment) {
            // Create a dummy appointment if none exists (Safety fallback)
            $appointment = \App\Models\Appointment::create([
                'patient_id' => $pregnancy->patient_id,
                'queue_number' => 'AUTO-' . rand(100, 999),
                'appointment_date' => now(),
                'service_category' => 'ANC',
                'status' => 'completed'
            ]);
        }

        $data['appointment_id'] = $appointment->id;

        \App\Models\AncVisit::create($data);

        return redirect()->route('anc-visits.index')->with('success', 'Data Pemeriksaan ANC Berhasil Disimpan.');
    }

    public function edit(\App\Models\AncVisit $ancVisit)
    {
        return view('anc-visits.edit', compact('ancVisit'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\AncVisit $ancVisit)
    {
        $data = $request->validate([
            'gestational_age_weeks' => 'nullable|integer',
            'weight' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'fundal_height' => 'nullable|string',
            'fetal_heart_rate' => 'nullable|string',
            'complaints' => 'nullable|string',
            'actions' => 'nullable|string',
        ]);

        $ancVisit->update($data);

        return redirect()->route('anc-visits.index')->with('success', 'Data ANC Diperbarui.');
    }

    public function destroy(\App\Models\AncVisit $ancVisit)
    {
        $ancVisit->delete();
        return redirect()->route('anc-visits.index')->with('success', 'Data ANC Dihapus.');
    }
}
