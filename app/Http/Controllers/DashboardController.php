<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Patient;
use App\Models\Barangay;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $populationByBarangay = Barangay::leftJoin('families', 'families.barangay_id', '=', 'barangays.id')
            ->leftJoin('patients', 'patients.family_id', '=', 'families.id')
            ->selectRaw(
                'barangays.id as barangay_id, barangays.barangay_name, '
                . 'SUM(CASE WHEN patients.sex = "Male" THEN 1 ELSE 0 END) as males, '
                . 'SUM(CASE WHEN patients.sex = "Female" THEN 1 ELSE 0 END) as females, '
                . 'COUNT(patients.id) as total'
            )
            ->groupBy('barangays.id', 'barangays.barangay_name')
            ->orderBy('barangays.barangay_name')
            ->get();

        return view('dashboard', [
            'totalFamilies' => Family::count(),
            'totalPatients' => Patient::count(),
            'totalBarangays' => Barangay::count(),
            'recordsToday' => Patient::whereDate('created_at', now())->count(),
            'recentFamilies' => Family::with('barangay')->latest()->take(5)->get(),
            'recentPatients' => Patient::with('family.barangay')->latest()->take(5)->get(),
            'populationByBarangay' => $populationByBarangay,
        ]);
    }
}
