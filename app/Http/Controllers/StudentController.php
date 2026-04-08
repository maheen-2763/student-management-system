<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StudentupdateRequest;

class StudentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

$students = Student::where('user_id', Auth::id())
    ->when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    })
    ->paginate(10)->withQueryString();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Student::class);
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        $data = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('student_images', 'public');
                $data['image'] = $imagePath;
            }

        $data['user_id'] = Auth::id();
        
        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $this->authorize('view', $student);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $this->authorize('update', $student);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentupdateRequest $request, Student $student)
    {
        $this->authorize('update', $student);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            $imagePath = $request->file('image')->store('student_images', 'public');
            $data['image'] = $imagePath;
        }
        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
