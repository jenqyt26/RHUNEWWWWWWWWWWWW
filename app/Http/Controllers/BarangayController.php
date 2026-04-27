<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    public function index()
    {
        $barangays = Barangay::all();
        return view('barangays.index', compact('barangays'));
    }

    public function create()
    {
        return view('barangays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barangay_name' => 'required|string|max:255|unique:barangays,barangay_name',
        ]);
        
        Barangay::create($request->all());
        return redirect()->route('barangays.index')->with('success', 'Barangay created successfully.');
    }

    public function show(Barangay $barangay)
    {
        return view('barangays.show', compact('barangay'));
    }

    public function edit(Barangay $barangay)
    {
        return view('barangays.edit', compact('barangay'));
    }

    public function update(Request $request, Barangay $barangay)
    {
        $request->validate([
            'barangay_name' => 'required|string|max:255|unique:barangays,barangay_name,' . $barangay->id,
        ]);
        
        $barangay->update($request->all());
        return redirect()->route('barangays.index')->with('success', 'Barangay updated successfully.');
    }

    public function destroy(Barangay $barangay)
    {
        $barangay->delete();
        return redirect()->route('barangays.index')->with('success', 'Barangay deleted successfully.');
    }
}