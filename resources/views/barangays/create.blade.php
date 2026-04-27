@extends('layouts.app')

@section('content')

<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('barangays.index') }}" class="text-blue-600 hover:text-blue-800">← Back</a>
        <h2 class="text-2xl font-bold text-gray-800">Create New Barangay</h2>
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
        <form method="POST" action="{{ route('barangays.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="barangay_name" class="block text-sm font-medium text-gray-700 mb-2">Barangay Name</label>
                <input type="text" id="barangay_name" name="barangay_name" placeholder="Enter barangay name" value="{{ old('barangay_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4332] focus:border-transparent">
                @error('barangay_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-[#1a4332] text-white px-6 py-2 rounded-lg hover:bg-[#0f2818] transition">Save</button>
                <a href="{{ route('barangays.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
