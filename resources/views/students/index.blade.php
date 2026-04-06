<h3>All Students</h3>



@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>       
@endif

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="GET" action="{{ route('students.index') }}">
    <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
    <input type="submit" value="Search">
</form> 

<a href="{{ route('students.create') }}">Add Student</a>
<br>
<br>

<a href="{{ route('export.students', ['search' => request('search')]) }}">Export to Excel</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Actions</th>
    </tr>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->age }}</td>
        <td>
            <a href="{{ route('students.edit', $student->id) }}">Edit</a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
            </form>
        </td>
    </tr>
    @endforeach

    {{ $students->appends(['search' => request('search')])->links() }}

</table>