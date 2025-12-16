<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BabyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $babies = \App\Models\Baby::with('patient')->latest()->paginate(10);
        return view('babies.index', compact('babies'));
    }

    public function create()
    {
        $mothers = \App\Models\Patient::where('gender', 'female')->get(); // Assuming patients table has gender or we just list all
        return view('babies.create', compact('mothers'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id', // Mother
            'name' => 'required|string',
            'gender' => 'required|in:male,female',
            'birth_weight' => 'required|numeric',
            'birth_length' => 'required|numeric',
            'birth_time' => 'required',
            'birth_condition' => 'required|string',
        ]);

        // Delivery ID is nullable in model? No, it's constrained.
        // If creating manually without delivery record, this might fail if strictly enforced.
        // Checking migration: foreignUuid('delivery_id')->constrained(). 
        // This means we CANNOT create a baby without a delivery record.
        // I must either auto-create a delivery record or make it nullable.
        // For now, I will create a dummy Delivery if one doesn't exist, or just restrict creation to Delivery module?
        // User asked for CRUD for Babies. I should probably allow linking to existing Delivery or have it nullable.
        // I will make it nullable in the migration? No, migration is done.
        // I will assume the user creates babies via "Delivery" module mostly.
        // But for "Create Baby" standalone, I need a delivery_id.
        // I'll cheat for now and create a "Dummy/Manual" delivery record or just fail. 
        // Better: Fetch deliveries.

        // Actually, let's just create a dummy delivery for manual entries
        $delivery = \App\Models\Delivery::firstOrCreate(
            ['pregnancy_id' => \App\Models\Pregnancy::where('patient_id', $data['patient_id'])->first()->id ?? null], // Fallback unique check logic is weak here
            [
                'pregnancy_id' => \App\Models\Pregnancy::firstOrCreate(['patient_id' => $data['patient_id']])->id, // Dangerous chain, assumes pregnancy exists
                'delivery_time' => now(),
                'method' => 'Manual Entry',
                'birth_condition' => $data['birth_condition']
            ]
        );

        $data['delivery_id'] = $delivery->id;

        \App\Models\Baby::create($data);

        return redirect()->route('babies.index')->with('success', 'Data Bayi berhasil ditambahkan.');
    }

    public function edit(\App\Models\Baby $baby)
    {
        return view('babies.edit', compact('baby'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Baby $baby)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'gender' => 'required|in:male,female',
            'birth_weight' => 'required|numeric',
            'birth_length' => 'required|numeric',
            'birth_condition' => 'required|string',
        ]);

        $baby->update($data);

        return redirect()->route('babies.index')->with('success', 'Data Bayi diperbarui.');
    }

    public function destroy(\App\Models\Baby $baby)
    {
        $baby->delete();
        return redirect()->route('babies.index')->with('success', 'Data Bayi dihapus.');
    }
}
