@extends('layouts.app')

@section('content')

<div class="flex justify-between items-end">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Welcome back, MacHealth! 👋</h2>
        <p class="text-gray-500">Here's what's happening with your patient records today.</p>
    </div>
    <div class="bg-white px-4 py-2 rounded-lg shadow-sm border flex items-center gap-2 text-sm text-gray-600">
        <i class="far fa-calendar"></i> {{ now()->format('F d, Y') }}
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center gap-4">
        <i class="fas fa-users text-green-700 text-xl"></i>
        <div>
            <p class="text-xs text-gray-500">Total Families</p>
            <h3 class="text-2xl font-bold">{{ $totalFamilies }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center gap-4">
        <i class="fas fa-user-injured text-green-700 text-xl"></i>
        <div>
            <p class="text-xs text-gray-500">Total Patients</p>
            <h3 class="text-2xl font-bold">{{ $totalPatients }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center gap-4">
        <i class="fas fa-house-user text-green-700 text-xl"></i>
        <div>
            <p class="text-xs text-gray-500">Total Barangays</p>
            <h3 class="text-2xl font-bold">{{ $totalBarangays }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center gap-4">
        <i class="fas fa-folder-open text-green-700 text-xl"></i>
        <div>
            <p class="text-xs text-gray-500">Records Today</p>
            <h3 class="text-2xl font-bold">{{ $recordsToday }}</h3>
        </div>
    </div>

</div>

<!-- TABLES -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <div class="p-6 border-b">
        <h4 class="font-bold">Recent Families</h4>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-400 text-xs">
            <tr>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Barangay</th>
            </tr>
        </thead>
        <tbody>
        @forelse($recentFamilies as $family)
        <tr>
            <td class="px-6 py-4">{{ $family->family_name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ $family->barangay->barangay_name }}</td>
        </tr>
        @empty
        <tr><td colspan="2" class="text-center py-4">No data</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <div class="p-6 border-b">
        <h4 class="font-bold">Recent Patients</h4>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-400 text-xs">
            <tr>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Barangay</th>
            </tr>
        </thead>
        <tbody>
        @forelse($recentPatients as $patient)
        <tr>
            <td class="px-6 py-4">{{ $patient->patient_name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ $patient->family->barangay->barangay_name }}</td>
        </tr>
        @empty
        <tr><td colspan="2" class="text-center py-4">No data</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

</div>

@endsection