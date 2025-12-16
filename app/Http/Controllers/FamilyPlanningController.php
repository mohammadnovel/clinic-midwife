<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyPlanningController extends Controller
{
    public function index()
    {
        $records = \App\Models\FamilyPlanning::with('patient')->latest()->get();
        return view('family-plannings.index', compact('records'));
    }

    public function create()
    {
        $patients = \App\Models\Patient::all();
        return view('family-plannings.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'method' => 'required|string', // KB Suntik 1 Bulan, Pil, IUD
            'visit_date' => 'required|date',
            'weight' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'side_effects' => 'nullable|string',
        ]);

        // Logic for next visit based on method
        $nextVisit = null;
        $date = \Carbon\Carbon::parse($validated['visit_date']);

        if (str_contains(strtolower($validated['method']), '1 bulan')) {
            $nextVisit = $date->copy()->addMonth();
        } elseif (str_contains(strtolower($validated['method']), '3 bulan')) {
            $nextVisit = $date->copy()->addMonths(3);
        } elseif (str_contains(strtolower($validated['method']), 'pil')) {
            $nextVisit = $date->copy()->addMonth(); // Usually refill
        }

        // Auto-create Appointment
        $appointment = \App\Models\Appointment::create([
            'patient_id' => $validated['patient_id'],
            'midwife_id' => auth()->user()->midwife ? auth()->user()->midwife->id : null,
            'queue_number' => 'KB-' . rand(100, 999),
            'appointment_date' => $validated['visit_date'],
            'service_category' => 'Family Planning',
            'status' => 'completed',
            'notes' => 'KB: ' . $validated['method']
        ]);

        \App\Models\FamilyPlanning::create([
            'patient_id' => $validated['patient_id'],
            'appointment_id' => $appointment->id,
            'method' => $validated['method'],
            'installation_date' => $validated['visit_date'],
            'next_visit_date' => $nextVisit,
            'weight' => $validated['weight'],
            'blood_pressure' => $validated['blood_pressure'],
            'side_effects' => $validated['side_effects'],
        ]);

        return redirect()->route('family-plannings.index')->with('success', 'Data KB berhasil dicatat. Kunjungan ulang: ' . ($nextVisit ? $nextVisit->format('d M Y') : '-'));
    }

    public function edit(\App\Models\FamilyPlanning $familyPlanning)
    {
        return view('family-plannings.edit', compact('familyPlanning'));
    }

    public function update(Request $request, \App\Models\FamilyPlanning $familyPlanning)
    {
        $data = $request->validate([
            'method' => 'required|string',
            'next_visit_date' => 'nullable|date',
            'weight' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'side_effects' => 'nullable|string',
        ]);

        $familyPlanning->update($data);

        return redirect()->route('family-plannings.index')->with('success', 'Data KB diperbarui.');
    }

    public function destroy(\App\Models\FamilyPlanning $familyPlanning)
    {
        $familyPlanning->delete();
        return redirect()->route('family-plannings.index')->with('success', 'Data dihapus.');
    }
}
