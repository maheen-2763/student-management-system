<h3>Update Student</h3>

<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $student->name }}" placeholder="Enter Name"><br>
    @error('name')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    <input type="text" name="email" value="{{ $student->email }}" placeholder="Enter Email"><br>
    @error('email')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    <input type="number" name="age" value="{{ $student->age }}" placeholder="Enter Age"><br>
    @error('age')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    <input type="submit" value="Update Student">
</form>


