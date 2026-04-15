<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Exports\StudentsExport;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('students', \App\Http\Controllers\StudentController::class);
    });

Route::get('/export-students', function (Request $request) {
    return Excel::download(new StudentsExport($request->input('search')), 'students.xlsx');
})->name('export.students');





require __DIR__.'/auth.php';
