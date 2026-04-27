@extends('layouts.app')

@section('content')

<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('patients.index') }}" class="text-blue-600 hover:text-blue-800">← Back</a>
        <h2 class="text-2xl font-bold text-gray-800">Create New Patient</h2>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form method="POST" action="{{ route('patients.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="patient_name" class="block text-sm font-medium text-gray-700 mb-2">Patient Name</label>
                <input type="text" id="patient_name" name="patient_name" placeholder="Enter patient name" value="{{ old('patient_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                @error('patient_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="family_id" class="block text-sm font-medium text-gray-700 mb-2">Family</label>
                <select id="family_id" name="family_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                    <option value="">-- Select Family --</option>
                    @foreach($families as $f)
                        <option value="{{ $f->id }}" {{ old('family_id') == $f->id ? 'selected' : '' }}>
                            {{ $f->family_name }}
                        </option>
                    @endforeach
                </select>
                @error('family_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-2">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                @error('birthdate')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="sex" class="block text-sm font-medium text-gray-700 mb-2">Sex</label>
                <select id="sex" name="sex" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                    <option value="">-- Select Sex --</option>
                    <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('sex')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" placeholder="Enter contact number" value="{{ old('contact_number') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                @error('contact_number')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-[#1a4332] text-white px-6 py-2 rounded-lg hover:bg-[#0f2818] transition">Save</button>
                <a href="{{ route('patients.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection