@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Add Student</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" 
                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" 
                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Age</label>
            <input type="number" name="age" 
                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Profile Image</label>
            <input type="file" name="image" 
                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save Student
        </button>

        <a href="{{ route('students.index') }}" class="ml-3 text-gray-600">
            Cancel
        </a>

    </form>
</div>
@endsection