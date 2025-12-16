<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
        }

        $patients = $query->latest()->paginate(10);

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:patients,nik',
            'phone' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string',
            'husband_name' => 'nullable|string',
        ]);

        Patient::create($data);

        return redirect()->route('patients.index')->with('success', 'Patient registered successfully.');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:patients,nik,' . $patient->id,
            'phone' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string',
            'husband_name' => 'nullable|string',
        ]);

        $patient->update($data);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}
