<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = \App\Models\Delivery::with(['pregnancy.patient'])->latest()->paginate(10);
        return view('deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        // Only active pregnancies can have a delivery recorded
        $pregnancies = \App\Models\Pregnancy::with('patient')->where('status', 'active')->get();
        return view('deliveries.create', compact('pregnancies'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'pregnancy_id' => 'required|exists:pregnancies,id',
            'delivery_time' => 'required|date',
            'method' => 'required|string', // Normal, Sectio, etc.
            'birth_condition' => 'required|string',
            'gender' => 'required|in:male,female', // For Baby creation
            'birth_weight' => 'required|numeric',
            'birth_length' => 'required|numeric',
            'baby_name' => 'nullable|string',
        ]);

        // Create Delivery Record
        $delivery = \App\Models\Delivery::create([
            'pregnancy_id' => $data['pregnancy_id'],
            'delivery_time' => $data['delivery_time'],
            'method' => $data['method'],
            'birth_condition' => $data['birth_condition'],
        ]);

        // Automatically Create Baby Record
        $pregnancy = \App\Models\Pregnancy::find($data['pregnancy_id']);

        \App\Models\Baby::create([
            'delivery_id' => $delivery->id,
            'patient_id' => $pregnancy->patient_id, // Mother
            'name' => $data['baby_name'] ?? 'Bayi Ny. ' . $pregnancy->patient->name,
            'gender' => $data['gender'],
            'birth_weight' => $data['birth_weight'],
            'birth_length' => $data['birth_length'],
            'birth_time' => \Carbon\Carbon::parse($data['delivery_time'])->format('H:i'),
            'birth_condition' => $data['birth_condition'] // reuse
        ]);

        // Mark Pregnancy as Delivered
        $pregnancy->update(['status' => 'delivered']);

        return redirect()->route('deliveries.index')->with('success', 'Persalinan berhasil dicatat & Data Bayi dibuat.');
    }

    public function edit(\App\Models\Delivery $delivery)
    {
        return view('deliveries.edit', compact('delivery'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Delivery $delivery)
    {
        $data = $request->validate([
            'delivery_time' => 'required|date',
            'method' => 'required|string',
            'birth_condition' => 'required|string',
        ]);

        $delivery->update($data);

        return redirect()->route('deliveries.index')->with('success', 'Data Persalinan diperbarui.');
    }

    public function destroy(\App\Models\Delivery $delivery)
    {
        $delivery->delete(); // Cascades delete to baby usually, or handled by DB
        return redirect()->route('deliveries.index')->with('success', 'Data Persalinan dihapus.');
    }
}
