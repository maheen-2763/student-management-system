@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 text-center">

        {{-- Profile Image --}}
        <div class="flex justify-center">
            @if ($student->image)
                <img src="{{ asset('storage/' . $student->image) }}" 
                     alt="Student Image" 
                     class="w-32 h-32 object-cover rounded-full border-4 border-blue-500 shadow-md">
            @else
                <div class="w-32 h-32 flex items-center justify-center rounded-full bg-gray-200 text-gray-500">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
            @endif
        </div>

        {{-- Name --}}
        <h2 class="text-2xl font-bold mt-4 text-gray-800">
            {{ $student->name }}
        </h2>

        {{-- Email --}}
        <p class="text-gray-500 mt-1">
            {{ $student->email }}
        </p>

        {{-- Divider --}}
        <div class="border-t my-4"></div>

        {{-- Details --}}
        <div class="text-left space-y-2">
            <p class="text-gray-700">
                <strong>Age:</strong> {{ $student->age }}
            </p>
        </div>

        {{-- Button --}}
        <div class="mt-6">
            <a href="{{ route('students.index') }}" 
               class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                ← Back to Students
            </a>
        </div>

    </div>

</div>
@endsection