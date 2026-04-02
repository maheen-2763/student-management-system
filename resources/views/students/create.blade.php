<h3>Add Student</h3>

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Enter Name" value="{{ old('name') }}"><br>
    @error('name')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    <input type="text" name="email" placeholder="Enter Email" value="{{ old('email') }}"><br>
    @error('email')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    <input type="number" name="age" placeholder="Enter Age" value="{{ old('age') }}"><br>
    @error('age')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    <input type="submit" value="Add Student">
</form>
