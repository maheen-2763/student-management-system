<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('students', \App\Http\Controllers\StudentController::class);
});


use App\Exports\StudentsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/export-students', function (Request $request) {
    return Excel::download(new StudentsExport($request->get('search')), 'students.xlsx');
})->name('export.students');



require __DIR__.'/auth.php';
