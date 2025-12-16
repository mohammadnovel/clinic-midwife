<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PncVisitController extends Controller
{
    public function index()
    {
        $visits = \App\Models\PncVisit::with(['delivery.patient', 'appointment'])->latest()->get();
        return view('pnc-visits.index', compact('visits'));
    }

    public function create()
    {
        // Only show deliveries that don't have all PNCs? Or just list all recent deliveries.
        $deliveries = \App\Models\Delivery::with('patient')->latest()->get();
        return view('pnc-visits.create', compact('deliveries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'delivery_id' => 'required|exists:deliveries,id',
            'visit_code' => 'required|string', // KF1, KF2...
            'appointment_date' => 'required|date',
            'lochia_condition' => 'nullable|string',
            'uterine_involution' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'breastfeeding_status' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $delivery = \App\Models\Delivery::find($validated['delivery_id']);

        // Auto-create Appointment
        $appointment = \App\Models\Appointment::create([
            'patient_id' => $delivery->patient_id, // Mother
            'midwife_id' => auth()->user()->midwife ? auth()->user()->midwife->id : null,
            'queue_number' => 'PNC-' . rand(100, 999),
            'appointment_date' => $validated['appointment_date'],
            'service_category' => 'Postnatal Care',
            'status' => 'completed',
            'notes' => 'Generated from PNC Visit'
        ]);

        \App\Models\PncVisit::create([
            'delivery_id' => $validated['delivery_id'],
            'appointment_id' => $appointment->id,
            'visit_code' => $validated['visit_code'],
            'lochia_condition' => $validated['lochia_condition'],
            'uterine_involution' => $validated['uterine_involution'],
            'blood_pressure' => $validated['blood_pressure'],
            'breastfeeding_status' => $request->has('breastfeeding_status') ? 1 : 0,
            'notes' => $validated['notes']
        ]);

        return redirect()->route('pnc-visits.index')->with('success', 'Kunjungan Nifas berhasil dicatat.');
    }

    public function edit(\App\Models\PncVisit $pncVisit)
    {
        return view('pnc-visits.edit', compact('pncVisit'));
    }

    public function update(Request $request, \App\Models\PncVisit $pncVisit)
    {
        $data = $request->validate([
            'visit_code' => 'required|string',
            'lochia_condition' => 'nullable|string',
            'uterine_involution' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'breastfeeding_status' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $data['breastfeeding_status'] = $request->has('breastfeeding_status') ? 1 : 0;

        $pncVisit->update($data);

        return redirect()->route('pnc-visits.index')->with('success', 'Data PNC diperbarui.');
    }

    public function destroy(\App\Models\PncVisit $pncVisit)
    {
        $pncVisit->delete();
        return redirect()->route('pnc-visits.index')->with('success', 'Data dihapus.');
    }
}
