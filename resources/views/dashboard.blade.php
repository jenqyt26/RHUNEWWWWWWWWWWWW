@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Welcome back, MacHealth! 👋</h2>
        <p class="text-gray-500">Monitor your patient records easily</p>
    </div>

    <div class="bg-gradient-to-r from-green-600 to-green-400 text-white px-5 py-2 rounded-xl shadow">
        <i class="far fa-calendar"></i> {{ now()->format('F d, Y') }}
    </div>
</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-gradient-to-r from-green-500 to-green-700 text-white p-6 rounded-2xl shadow hover:scale-105 transition">
        <p class="text-sm opacity-80">Total Families</p>
        <h3 class="text-3xl font-bold">{{ $totalFamilies }}</h3>
    </div>

    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-2xl shadow hover:scale-105 transition">
        <p class="text-sm opacity-80">Total Patients</p>
        <h3 class="text-3xl font-bold">{{ $totalPatients }}</h3>
    </div>

    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 rounded-2xl shadow hover:scale-105 transition">
        <p class="text-sm opacity-80">Total Barangays</p>
        <h3 class="text-3xl font-bold">{{ $totalBarangays }}</h3>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-700 text-white p-6 rounded-2xl shadow hover:scale-105 transition">
        <p class="text-sm opacity-80">Records Today</p>
        <h3 class="text-3xl font-bold">{{ $recordsToday }}</h3>
    </div>

</div>

<!-- TABLE SECTION -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

<!-- Recent Families -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="p-5 border-b bg-gray-50">
        <h4 class="font-semibold text-gray-700">Recent Families</h4>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Barangay</th>
            </tr>
        </thead>
        <tbody>
        @forelse($recentFamilies as $family)
        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 font-medium">{{ $family->family_name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ $family->barangay->barangay_name }}</td>
        </tr>
        @empty
        <tr><td colspan="2" class="text-center py-4 text-gray-400">No data</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Recent Patients -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="p-5 border-b bg-gray-50">
        <h4 class="font-semibold text-gray-700">Recent Patients</h4>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Barangay</th>
            </tr>
        </thead>
        <tbody>
        @forelse($recentPatients as $patient)
        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 font-medium">{{ $patient->patient_name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ $patient->family->barangay->barangay_name }}</td>
        </tr>
        @empty
        <tr><td colspan="2" class="text-center py-4 text-gray-400">No data</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

</div>

<!-- POPULATION TABLE -->
<div class="mt-8 bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="p-5 border-b bg-gray-50">
        <h4 class="font-semibold text-gray-700">Population by Barangay</h4>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-6 py-3 text-left">Barangay</th>
                <th class="px-6 py-3 text-left">Male</th>
                <th class="px-6 py-3 text-left">Female</th>
                <th class="px-6 py-3 text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($populationByBarangay as $stat)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium">{{ $stat->barangay_name }}</td>
                    <td class="px-6 py-4">{{ $stat->males }}</td>
                    <td class="px-6 py-4">{{ $stat->females }}</td>
                    <td class="px-6 py-4 font-semibold text-green-600">{{ $stat->total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-400">No population data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection