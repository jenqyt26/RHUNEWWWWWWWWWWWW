@extends('layouts.app')

@section('content')

<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('barangays.index') }}" class="text-blue-600 hover:text-blue-800">← Back</a>
        <h2 class="text-2xl font-bold text-gray-800">{{ $barangay->barangay_name }}</h2>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
        <div>
            <p class="text-xs text-gray-500 uppercase">ID</p>
            <p class="text-lg font-medium text-gray-800">{{ $barangay->id }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase">Created</p>
            <p class="text-lg font-medium text-gray-800">{{ $barangay->created_at->format('M d, Y \a\t H:i') }}</p>
        </div>

        <div class="border-t pt-6 flex gap-3">
            <a href="{{ route('barangays.edit', $barangay) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">Edit</a>
            <form method="POST" action="{{ route('barangays.destroy', $barangay) }}" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection

