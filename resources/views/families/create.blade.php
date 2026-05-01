@extends('layouts.app')

@section('content')

<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('families.index') }}" class="text-blue-600 hover:text-blue-800">← Back</a>
        <h2 class="text-2xl font-bold text-gray-800">Create New Family</h2>
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
        <form method="POST" action="{{ route('families.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="family_name" class="block text-sm font-medium text-gray-700 mb-2">Family Name</label>
                <input type="text" id="family_name" name="family_name" placeholder="Enter family name" value="{{ old('family_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                @error('family_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="barangay_id" class="block text-sm font-medium text-gray-700 mb-2">Barangay</label>
                <select id="barangay_id" name="barangay_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                    <option value="">-- Select Barangay --</option>
                    @foreach($barangays as $b)
                        <option value="{{ $b->id }}" {{ old('barangay_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->barangay_name }}
                        </option>
                    @endforeach
                </select>
                @error('barangay_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="family_number" class="block text-sm font-medium text-gray-700 mb-2">Folder Number</label>
                <input type="number" id="family_number" name="family_number" placeholder="Leave blank to auto-assign" value="{{ old('family_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Optional. If blank, the next number for the selected barangay is assigned.</p>
                @error('family_number')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-[#1a4332] text-white px-6 py-2 rounded-lg hover:bg-[#0f2818] transition">Save</button>
                <a href="{{ route('families.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection