@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Student</h2>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Name</label>
            <input 
                type="text" 
                name="name" 
                value="{{ old('name', $student->name) }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Email</label>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email', $student->email) }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Age -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-1">Age</label>
            <input 
                type="number" 
                name="age" 
                value="{{ old('age', $student->age) }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('age')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

         <div class="mb-4">
            <label class="block mb-1">Profile Image</label>
            <input type="file" name="image" value="{{ old('image', $student->image) }}"
                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>

        @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- Buttons -->
        <div class="flex items-center gap-3">
            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Update Student
            </button>

            <a href="{{ route('students.index') }}" 
               class="text-gray-600 hover:underline">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection