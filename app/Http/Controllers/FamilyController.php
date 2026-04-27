<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Barangay;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::with('barangay')->get();
        return view('families.index', compact('families'));
    }

    public function create()
    {
        $barangays = Barangay::all();
        return view('families.create', compact('barangays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'family_name' => 'required|string|max:255',
            'barangay_id' => 'required|exists:barangays,id',
        ]);
        
        Family::create($request->all());
        return redirect()->route('families.index')->with('success', 'Family created successfully.');
    }

    public function show(Family $family)
    {
        $family->load('barangay');
        return view('families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        $barangays = Barangay::all();
        return view('families.edit', compact('family', 'barangays'));
    }

    public function update(Request $request, Family $family)
    {
        $request->validate([
            'family_name' => 'required|string|max:255',
            'barangay_id' => 'required|exists:barangays,id',
        ]);
        
        $family->update($request->all());
        return redirect()->route('families.index')->with('success', 'Family updated successfully.');
    }

    public function destroy(Family $family)
    {
        $family->delete();
        return redirect()->route('families.index')->with('success', 'Family deleted successfully.');
    }
}