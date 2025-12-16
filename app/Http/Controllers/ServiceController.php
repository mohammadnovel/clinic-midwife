<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = \App\Models\Service::paginate(10);
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:services,code',
            'category' => 'required|string',
            'price' => 'required|numeric',
        ]);

        \App\Models\Service::create($data);

        return redirect()->route('services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(\App\Models\Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:services,code,' . $service->id,
            'category' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(\App\Models\Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
