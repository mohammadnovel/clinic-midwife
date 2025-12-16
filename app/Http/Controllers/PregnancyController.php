<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PregnancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pregnancies = \App\Models\Pregnancy::with('patient')->latest()->get();
        return view('pregnancies.index', compact('pregnancies'));
    }

    public function create()
    {
        $patients = \App\Models\Patient::all();
        return view('pregnancies.create', compact('patients'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'hpht' => 'required|date',
            'gravida' => 'required|integer',
            'partus' => 'required|integer',
            'abortus' => 'required|integer',
            'history_notes' => 'nullable|string',
        ]);

        // Calculate HPL (Naegele's rule: +7 days, -3 months, +1 year OR +7 days, +9 months)
        // Simple logic: +280 days
        $hpht = \Carbon\Carbon::parse($data['hpht']);
        $data['hpl'] = $hpht->copy()->addDays(280);
        $data['status'] = 'active';

        \App\Models\Pregnancy::create($data);

        return redirect()->route('pregnancies.index')->with('success', 'Data Kehamilan berhasil ditambahkan.');
    }

    public function edit(\App\Models\Pregnancy $pregnancy)
    {
        return view('pregnancies.edit', compact('pregnancy'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Pregnancy $pregnancy)
    {
        $data = $request->validate([
            'status' => 'required|in:active,delivered,aborted',
            'history_notes' => 'nullable|string',
        ]);

        $pregnancy->update($data);

        return redirect()->route('pregnancies.index')->with('success', 'Status Kehamilan diperbarui.');
    }

    public function destroy(\App\Models\Pregnancy $pregnancy)
    {
        $pregnancy->delete();
        return redirect()->route('pregnancies.index')->with('success', 'Data dihapus.');
    }
}
