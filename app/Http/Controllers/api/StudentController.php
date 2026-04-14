<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    // GET /api/students
    public function index(Request $request)
{

    $query = Student::where('user_id', Auth::id());

    if($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");  
        });
    }
    if($request->sort == "oldest") {
        $query->oldest();
    } else {
        $query->latest();

    }

    $students = $query->paginate(10);

    return successResponse([
        'students' => StudentResource::collection($students),
        'meta' => [
            'current_page' => $students->currentPage(),
            'last_page' => $students->lastPage(),
            'per_page' => $students->perPage(),
            'total' => $students->total(),
        ]
    ]);

    
}

    // POST /api/students
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();

        $student = Student::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],   
            'email' => $validated['email'],
            'age' => $validated['age'],
        ]);
        return successResponse(new StudentResource($student), 'Student created successfully');
    }

    // GET /api/students/{id}
    public function show($id)
    {
        $student = Student::where('user_id', Auth::id())->findOrFail($id);
 
        return successResponse(new StudentResource($student), 'Student retrieved successfully');
    }
    // PUT /api/students/{id}
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::where('user_id', Auth::id())->findOrFail($id);
      
        $student->update($request->validated());

        return successResponse(new StudentResource($student), 'Student updated successfully');
    }

    // DELETE /api/students/{id}
    public function destroy($id)
{
    $student = Student::where('user_id', Auth::id())->findOrFail($id);

    $student->delete();

    return successResponse(null, 'Student deleted successfully');
}
}

