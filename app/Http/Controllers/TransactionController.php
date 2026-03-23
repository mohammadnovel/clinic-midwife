<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Models\Patient;
use App\Models\Service;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('patient')->latest()->paginate(15);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $services = Service::where('is_active', true)->orderBy('name')->get();
        return view('transactions.create', compact('patients', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id'       => 'required|exists:patients,id',
            'items'            => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.qty'      => 'required|integer|min:1',
            'payment_method'   => 'required|in:cash,transfer,qris,bpjs',
            'payment_status'   => 'required|in:paid,unpaid',
        ]);

        $totalAmount   = 0;
        $itemsToInsert = [];

        foreach ($data['items'] as $item) {
            $service      = Service::findOrFail($item['service_id']);
            $qty          = (int) $item['qty'];
            $subtotal     = $service->price * $qty;
            $totalAmount += $subtotal;

            $itemsToInsert[] = [
                'item_name' => $service->name,
                'item_type' => 'service',
                'quantity'  => $qty,
                'price'     => $service->price,
                'subtotal'  => $subtotal,
            ];
        }

        // Generate unique invoice code
        do {
            $code = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Transaction::where('code', $code)->exists());

        $transaction = Transaction::create([
            'patient_id'     => $data['patient_id'],
            'code'           => $code,
            'total_amount'   => $totalAmount,
            'paid_amount'    => $data['payment_status'] === 'paid' ? $totalAmount : 0,
            'payment_status' => $data['payment_status'],
            'payment_method' => $data['payment_method'],
        ]);

        foreach ($itemsToInsert as $item) {
            DB::table('transaction_details')->insert(array_merge($item, [
                'id'             => (string) Str::uuid(),
                'transaction_id' => $transaction->id,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]));
        }

        return redirect()->route('transactions.index')
            ->with('success', "Transaksi {$code} berhasil dibuat. Total: Rp " . number_format($totalAmount, 0, ',', '.'));
    }

    public function show(Transaction $transaction)
    {
        $details = DB::table('transaction_details')
            ->where('transaction_id', $transaction->id)
            ->get();
        $transaction->load('patient');
        return view('transactions.show', compact('transaction', 'details'));
    }

    public function edit(Transaction $transaction)
    {
        $transaction->load(['patient', 'details']);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'payment_status' => 'required|in:paid,unpaid',
            'payment_method' => 'required|in:cash,transfer,qris,bpjs',
        ]);

        if ($data['payment_status'] === 'paid' && $transaction->paid_amount == 0) {
            $data['paid_amount'] = $transaction->total_amount;
        }

        $transaction->update($data);

        return redirect()->route('transactions.index')
            ->with('success', 'Status transaksi ' . $transaction->code . ' berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        DB::table('transaction_details')->where('transaction_id', $transaction->id)->delete();
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
