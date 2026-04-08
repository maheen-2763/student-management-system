<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $totalStudents = Student::where('user_id', Auth::id())->count();

        $latestStudent = Student::where('user_id', Auth::id())->latest()->first();

        $totalImages = Student::where('user_id', Auth::id())->whereNotNull('image')->count();

        return view('dashboard', compact('totalStudents', 'latestStudent', 'totalImages'));

    }
}
