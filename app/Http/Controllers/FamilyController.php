<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Barangay;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $barangayId = $request->query('barangay_id');
        $barangays = Barangay::orderBy('barangay_name')->get();

        $families = Family::with('barangay')
            ->when($barangayId, function ($query, $barangayId) {
                $query->where('barangay_id', $barangayId);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('family_name', 'like', "%{$search}%")
                        ->orWhere('family_number', 'like', "%{$search}%")
                        ->orWhereHas('barangay', function ($query) use ($search) {
                            $query->where('barangay_name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('patients', function ($query) use ($search) {
                            $query->where('patient_name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('barangay_id')
            ->orderBy('family_number')
            ->get();

        return view('families.index', compact('families', 'search', 'barangays', 'barangayId'));
    }

    public function create()
    {
        $barangays = Barangay::all();
        return view('families.create', compact('barangays'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_name' => 'required|string|max:255',
            'barangay_id' => 'required|exists:barangays,id',
            'family_number' => 'nullable|integer|min:1',
        ]);

        $familyNumber = $validated['family_number'] ?? null;

        if ($familyNumber !== null) {
            $exists = Family::where('barangay_id', $validated['barangay_id'])
                ->where('family_number', $familyNumber)
                ->exists();

            if ($exists) {
                return back()->withErrors(['family_number' => 'The folder number has already been taken for this barangay.'])->withInput();
            }
        }

        if ($familyNumber === null) {
            $nextFamilyNumber = Family::where('barangay_id', $validated['barangay_id'])
                ->max('family_number');
            $familyNumber = $nextFamilyNumber ? $nextFamilyNumber + 1 : 1;
        }

        Family::create([
            'family_name' => $validated['family_name'],
            'barangay_id' => $validated['barangay_id'],
            'family_number' => $familyNumber,
        ]);

        return redirect()->route('families.index')->with('success', 'Family created successfully.');
    }

    public function show(Family $family)
    {
        $family->load(['barangay', 'patients']);
        return view('families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        $barangays = Barangay::all();
        return view('families.edit', compact('family', 'barangays'));
    }

    public function update(Request $request, Family $family)
    {
        $validated = $request->validate([
            'family_name' => 'required|string|max:255',
            'barangay_id' => 'required|exists:barangays,id',
            'family_number' => 'nullable|integer|min:1',
        ]);

        $familyNumber = $validated['family_number'] ?? null;
        $newBarangayId = $validated['barangay_id'];

        if ($familyNumber !== null) {
            $exists = Family::where('barangay_id', $newBarangayId)
                ->where('family_number', $familyNumber)
                ->where('id', '<>', $family->id)
                ->exists();

            if ($exists) {
                return back()->withErrors(['family_number' => 'The folder number has already been taken for this barangay.'])->withInput();
            }
        }

        if ($familyNumber === null) {
            if ($family->barangay_id !== $newBarangayId) {
                $nextFamilyNumber = Family::where('barangay_id', $newBarangayId)
                    ->max('family_number');
                $familyNumber = $nextFamilyNumber ? $nextFamilyNumber + 1 : 1;
            } else {
                $familyNumber = $family->family_number;
            }
        }

        $family->update([
            'family_name' => $validated['family_name'],
            'barangay_id' => $newBarangayId,
            'family_number' => $familyNumber,
        ]);

        return redirect()->route('families.index')->with('success', 'Family updated successfully.');
    }

    public function destroy(Family $family)
    {
        $family->delete();
        return redirect()->route('families.index')->with('success', 'Family deleted successfully.');
    }
}