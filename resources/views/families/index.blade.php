<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Families</h2>
    <a href="{{ route('families.create') }}" class="bg-[#1a4332] text-white px-4 py-2 rounded-lg hover:bg-[#0f2818] transition">
        + Add Family
    </a>
</div>

@if ($message = session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ $message }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Family Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Barangay</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($families as $family)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $family->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $family->family_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $family->barangay->barangay_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $family->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('families.show', $family) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        <a href="{{ route('families.edit', $family) }}" class="text-yellow-600 hover:text-yellow-800">Edit</a>
                        <form method="POST" action="{{ route('families.destroy', $family) }}" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No families found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
</body>
</html>