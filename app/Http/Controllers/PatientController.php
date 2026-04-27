<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Family;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('family.barangay')->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $families = Family::all();
        return view('patients.create', compact('families'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'family_id' => 'required|exists:families,id',
            'birthdate' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'contact_number' => 'required|string|max:20',
        ]);
        
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $patient->load('family.barangay');
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $families = Family::all();
        return view('patients.edit', compact('patient', 'families'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'family_id' => 'required|exists:families,id',
            'birthdate' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'contact_number' => 'required|string|max:20',
        ]);
        
        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}