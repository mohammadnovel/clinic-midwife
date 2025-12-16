<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImmunizationRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = \App\Models\ImmunizationRecord::with(['patient', 'immunizationType'])->latest('date_given')->paginate(10);
        return view('immunizations.index', compact('records'));
    }

    public function create()
    {
        $patients = \App\Models\Patient::all(); // Assuming patients table includes children/babies or we filter by age
        $types = \App\Models\ImmunizationType::all();
        return view('immunizations.create', compact('patients', 'types'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'immunization_type_id' => 'required|exists:immunization_types,id',
            'date_given' => 'required|date',
            'batch_number' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Auto-create appointment link if needed, similar to ANC
        $appointment = \App\Models\Appointment::create([
            'patient_id' => $data['patient_id'],
            'queue_number' => 'IM-' . rand(100, 999),
            'appointment_date' => $data['date_given'],
            'service_category' => 'Immunization',
            'status' => 'completed'
        ]);

        $data['appointment_id'] = $appointment->id;

        \App\Models\ImmunizationRecord::create($data);

        return redirect()->route('immunizations.index')->with('success', 'Data Imunisasi berhasil dicatat.');
    }

    public function edit(\App\Models\ImmunizationRecord $immunization)
    {
        $types = \App\Models\ImmunizationType::all();
        return view('immunizations.edit', compact('immunization', 'types'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\ImmunizationRecord $immunization)
    {
        $data = $request->validate([
            'immunization_type_id' => 'required|exists:immunization_types,id',
            'date_given' => 'required|date',
            'batch_number' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $immunization->update($data);

        return redirect()->route('immunizations.index')->with('success', 'Data Imunisasi diperbarui.');
    }

    public function destroy(\App\Models\ImmunizationRecord $immunization)
    {
        $immunization->delete();
        return redirect()->route('immunizations.index')->with('success', 'Data Imunisasi dihapus.');
    }
}
