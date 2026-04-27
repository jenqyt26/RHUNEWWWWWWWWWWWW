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
        return view('dashboard', [
            'totalFamilies' => Family::count(),
            'totalPatients' => Patient::count(),
            'totalBarangays' => Barangay::count(),
            'recordsToday' => Patient::whereDate('created_at', now())->count(),
            'recentFamilies' => Family::with('barangay')->latest()->take(5)->get(),
            'recentPatients' => Patient::with('family.barangay')->latest()->take(5)->get()
        ]);
    }
}
