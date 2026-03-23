<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\Patient;
use App\Models\Midwife;
use App\Models\Appointment;

class ReferralController extends Controller
{
    public function index()
    {
        $referrals = Referral::with(['patient', 'midwife'])->latest()->paginate(15);
        return view('referrals.index', compact('referrals'));
    }

    public function create()
    {
        $patients     = Patient::orderBy('name')->get();
        $midwives     = Midwife::with('user')->where('is_active', true)->get();
        $appointments = Appointment::with('patient')
            ->whereDate('appointment_date', '>=', now()->subDays(7))
            ->latest()
            ->get();
        return view('referrals.create', compact('patients', 'midwives', 'appointments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id'     => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'referred_by'    => 'nullable|exists:midwives,id',
            'referral_date'  => 'required|date',
            'hospital_name'  => 'required|string|max:255',
            'hospital_address' => 'nullable|string',
            'diagnosis'      => 'required|string',
            'reason'         => 'required|string',
            'referral_type'  => 'required|in:emergency,regular',
            'status'         => 'required|in:pending,sent,received',
            'notes'          => 'nullable|string',
        ]);

        Referral::create($data);

        return redirect()->route('referrals.index')
            ->with('success', 'Surat rujukan berhasil dibuat.');
    }

    public function show(Referral $referral)
    {
        $referral->load(['patient', 'midwife', 'appointment']);
        return view('referrals.show', compact('referral'));
    }

    public function edit(Referral $referral)
    {
        $patients     = Patient::orderBy('name')->get();
        $midwives     = Midwife::with('user')->where('is_active', true)->get();
        $appointments = Appointment::with('patient')->latest()->limit(50)->get();
        return view('referrals.edit', compact('referral', 'patients', 'midwives', 'appointments'));
    }

    public function update(Request $request, Referral $referral)
    {
        $data = $request->validate([
            'patient_id'     => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'referred_by'    => 'nullable|exists:midwives,id',
            'referral_date'  => 'required|date',
            'hospital_name'  => 'required|string|max:255',
            'hospital_address' => 'nullable|string',
            'diagnosis'      => 'required|string',
            'reason'         => 'required|string',
            'referral_type'  => 'required|in:emergency,regular',
            'status'         => 'required|in:pending,sent,received',
            'notes'          => 'nullable|string',
        ]);

        $referral->update($data);

        return redirect()->route('referrals.index')
            ->with('success', 'Data rujukan berhasil diperbarui.');
    }

    public function destroy(Referral $referral)
    {
        $referral->delete();
        return redirect()->route('referrals.index')
            ->with('success', 'Data rujukan berhasil dihapus.');
    }
}
