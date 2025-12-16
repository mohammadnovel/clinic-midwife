<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = \App\Models\Transaction::with('patient')->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $patients = \App\Models\Patient::all();
        $services = \App\Models\Service::all();
        return view('transactions.create', compact('patients', 'services'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'items' => 'required|array', // Logic for handling dynamic items can be complex. 
            // Supporting simple single item for now or multiple via array.
            // Let's assume we pass an array of service IDs for simplicity first OR handle JS form submission.
            // To make it robust without complex JS right now, I'll allow selecting ONE primary service,
            // or trust the user to build a proper form later?
            // User wants FULL CRUD. I will implement a multi-select for known services.
            'items.*' => 'exists:services,id',
            'payment_method' => 'required|string',
            'payment_status' => 'required|in:paid,unpaid'
        ]);

        // Create Code
        $code = 'INV-' . date('Ymd') . '-' . rand(1000, 9999);

        $totalAmount = 0;
        $itemsToInsert = [];

        foreach ($data['items'] as $serviceId) {
            $service = \App\Models\Service::find($serviceId);
            $totalAmount += $service->price;
            $itemsToInsert[] = [
                'item_name' => $service->name,
                'item_type' => 'Service',
                'quantity' => 1,
                'price' => $service->price,
                'subtotal' => $service->price
            ];
        }

        $transaction = \App\Models\Transaction::create([
            'patient_id' => $data['patient_id'],
            'code' => $code,
            'total_amount' => $totalAmount,
            'paid_amount' => $data['payment_status'] == 'paid' ? $totalAmount : 0,
            'payment_status' => $data['payment_status'],
            'payment_method' => $data['payment_method'],
        ]);

        // Insert Details
        foreach ($itemsToInsert as $item) {
            // We need transaction detail model or DB insert
            // Assuming TransactionDetail model exists and relationship is set or we use DB
            // The migration had TransactionDetail.
            // I'll assume relationship 'details'
            // Or better, create manually
            \Illuminate\Support\Facades\DB::table('transaction_details')->insert(array_merge($item, [
                'id' => \Illuminate\Support\Str::uuid(),
                'transaction_id' => $transaction->id,
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat. Total: Rp ' . number_format($totalAmount));
    }

    public function show(\App\Models\Transaction $transaction)
    {
        // Show invoice details (can be used as "Print" page later)
        // Need to load details
        // For now, reuse edit or create simple show
        $details = \Illuminate\Support\Facades\DB::table('transaction_details')->where('transaction_id', $transaction->id)->get();
        return view('transactions.show', compact('transaction', 'details'));
    }

    public function edit(\App\Models\Transaction $transaction)
    {
        // Basic status update
        return view('transactions.edit', compact('transaction'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Transaction $transaction)
    {
        $data = $request->validate([
            'payment_status' => 'required|in:paid,unpaid',
            'payment_method' => 'nullable|string',
        ]);

        if ($data['payment_status'] == 'paid' && $transaction->paid_amount == 0) {
            $data['paid_amount'] = $transaction->total_amount;
        }

        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaksi diperbarui.');
    }

    public function destroy(\App\Models\Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi dihapus.');
    }
}
