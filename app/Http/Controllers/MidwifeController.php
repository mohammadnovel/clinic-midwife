<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidwifeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $midwives = \App\Models\Midwife::with('user')->paginate(10);
        return view('midwives.index', compact('midwives'));
    }

    public function create()
    {
        return view('midwives.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'sip_number' => 'required|string|max:50|unique:midwives',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'required|min:6',
            'photo_path' => 'nullable|url',
            'bio' => 'nullable|string'
        ]);

        // Create User first
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
        ]);
        $user->assignRole('bidan');

        \App\Models\Midwife::create([
            'user_id' => $user->id,
            'sip_number' => $data['sip_number'],
            'phone' => $data['phone'] ?? null,
        ]);

        return redirect()->route('midwives.index')->with('success', 'Bidan berhasil ditambahkan.');
    }

    public function edit(\App\Models\Midwife $midwife)
    {
        return view('midwives.edit', compact('midwife'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Midwife $midwife)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'sip_number' => 'required|string|unique:midwives,sip_number,' . $midwife->id,
            'phone' => 'nullable|string',
        ]);

        $midwife->user->update(['name' => $data['name']]);
        $midwife->update([
            'sip_number' => $data['sip_number'],
            'phone' => $data['phone']
        ]);

        return redirect()->route('midwives.index')->with('success', 'Data Bidan berhasil diperbarui.');
    }

    public function destroy(\App\Models\Midwife $midwife)
    {
        // Optional: Delete user account too if needed
        $user = $midwife->user;
        $midwife->delete();
        if ($user)
            $user->delete();

        return redirect()->route('midwives.index')->with('success', 'Bidan berhasil dihapus.');
    }
}
