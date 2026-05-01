@extends('layouts.app')

@section('content')

<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('families.index') }}" class="text-blue-600 hover:text-blue-800">← Back</a>
        <h2 class="text-2xl font-bold text-gray-800">{{ $family->family_name }}</h2>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
        <div>
            <p class="text-xs text-gray-500 uppercase">Folder No</p>
            <p class="text-lg font-medium text-gray-800">{{ $family->family_number }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase">Barangay</p>
            <p class="text-lg font-medium text-gray-800">{{ $family->barangay->barangay_name }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase">Created</p>
            <p class="text-lg font-medium text-gray-800">{{ $family->created_at->format('M d, Y \a\t H:i') }}</p>
        </div>

        <div class="border-t pt-6 flex gap-3">
            <a href="{{ route('families.edit', $family) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">Edit</a>
            <form method="POST" action="{{ route('families.destroy', $family) }}" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Delete</button>
            </form>
        </div>
    </div>

<div class="bg-white rounded-lg shadow-sm p-6 mt-8" id="family-members">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Family Members</h3>
                    <p class="text-sm text-gray-500">All members under this family record.</p>
                </div>
                <a href="#family-members" class="text-sm font-medium text-blue-600 hover:text-blue-800">View Members</a>
        </div>

        @if($family->patients->isEmpty())
            <div class="py-10 text-center text-gray-500">No family members found.</div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Gender</th>
                        <th class="px-4 py-3 text-left">Birthdate</th>
                        <th class="px-4 py-3 text-left">Contact</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($family->patients as $patient)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-800">{{ $patient->patient_name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $patient->sex }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($patient->birthdate)->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $patient->contact_number }}</td>
                            <td class="px-4 py-3 text-gray-600 space-x-2">
                                <a href="{{ route('patients.edit', $patient) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="inline-block" onsubmit="return confirm('Delete this member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
