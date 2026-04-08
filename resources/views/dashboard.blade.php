@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">

    <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Students -->
        <div class="bg-blue-500 text-white p-6 rounded shadow">
            <h3 class="text-lg">Total Students</h3>
            <p class="text-3xl font-bold">{{ $totalStudents ?? 0 }}</p>
        </div>

        <!-- Latest Student -->
        <div class="bg-green-500 text-white p-6 rounded shadow">
            <h3 class="text-lg">Latest Student</h3>
            <p class="text-xl">{{ $latestStudent->name ?? 'N/A' }}</p>
        </div>

        <!-- Total Images -->
        <div class="bg-yellow-500 text-white p-6 rounded shadow">
            <h3 class="text-lg">Total Images</h3>
            <p class="text-3xl font-bold">{{ $totalImages ?? 0 }}</p>
        </div>


</div>
@endsection