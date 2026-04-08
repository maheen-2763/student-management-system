@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold">Students</h2>

       <a href="{{ route('students.create') }}"
            class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow">
             ➕ Add Student
            </a>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-800/30 text-green-700 dark:text-green-300 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 dark:bg-red-800/30 text-red-700 dark:text-red-300 p-3 rounded-lg mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Search + Export --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-4">

        <form method="GET" action="{{ route('students.index') }}" class="flex gap-2 w-full md:w-auto">
            <input 
                type="text" 
                name="search" 
                placeholder="Search students..." 
                value="{{ request('search') }}"
                class="w-full md:w-72 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700"
            >

            <button class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-black transition">
    🔍 Search
</button>
        </form>

       <a href="{{ route('export.students', ['search' => request('search')]) }}"
   class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition shadow">
    📊 Export
</a>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm">

            {{-- Head --}}
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Age</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            {{-- Body --}}
            <tbody>
                @forelse($students as $student)
                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                        {{-- User (Image + Name) --}}
                        <td class="p-4 flex items-center gap-3">
                            @if($student->image)
                                <img src="{{ asset('storage/' . $student->image) }}"
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-600">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                            @endif

                            <div>
                                <p class="font-medium">{{ $student->name }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $student->id }}</p>
                            </div>
                        </td>

                        {{-- Email --}}
                        <td class="p-4">{{ $student->email }}</td>

                        {{-- Age --}}
                        <td class="p-4 text-center">{{ $student->age }}</td>

                        {{-- Status --}}
                        <td class="p-4 text-center">
                            @if($student->image)
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                    Complete
                                </span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                                    No Image
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="p-4 text-center">
    <div class="flex justify-center gap-2">

        {{-- View --}}
        <a href="{{ route('students.show', $student->id) }}"
           class="flex items-center gap-1 bg-blue-500 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-600 transition shadow">
            👁 View
        </a>

        {{-- Edit --}}
        <a href="{{ route('students.edit', $student->id) }}"
           class="flex items-center gap-1 bg-yellow-500 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-yellow-600 transition shadow">
            ✏️ Edit
        </a>

        {{-- Delete --}}
        <form action="{{ route('students.destroy', $student->id) }}" 
              method="POST">
            @csrf
            @method('DELETE')

            <button 
                onclick="return confirm('Delete this student?')"
                class="flex items-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-red-600 transition shadow">
                🗑 Delete
            </button>
        </form>

    </div>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-10 text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                📭
                                <p>No students found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $students->appends(['search' => request('search')])->links() }}
    </div>

</div>

@endsection