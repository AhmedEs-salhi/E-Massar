<?php

use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Teacher\MarkController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->middleware('guest')->name('welcome');

Route::middleware(['auth'])->group(function () {

    // --- ADMIN ROUTES ---
    Route::middleware('role:admin')->name('admin.')->group(function () {
        Route::get('admin/dashboard', [AdminDashboardController::class, 'userCards'])->name('dashboard');

        Route::get('admin/students', [UserController::class, 'students'])->name('students');
        Route::get('admin/student/{id}/edit', [UserController::class, 'edit'])->name('student.edit');
        Route::get('admin/student/{id}', [UserController::class, 'show'])->name('student.show');
        Route::patch('/student/{id}', [UserController::class, 'update'])->name('student.update');

        Route::get('admin/add-student', [UserController::class, 'create'])->name('add-student');
        Route::delete('/students/{id}', [UserController::class, 'destroy'])->name('students.destroy');
        Route::resource('classes', ClasseController::class);
        Route::resource('subjects', SubjectController::class);
        Route::get('admin/add-teacher', [UserController::class, 'teachers'])->name('add-teacher');

        Route::get('admin/add-user', [UserController::class, 'create'])->name('add-user');
        Route::post('admin/add-user', [UserController::class, 'store'])->name('add-user');

        Route::get('admin/teachers', [UserController::class, 'teachers'])->name('teachers');
        Route::get('admin/teacher/{id}/edit', [UserController::class, 'edit'])->name('teacher.edit');
        Route::get('admin/teacher/{id}', [UserController::class, 'show'])->name('teacher.show');
    });

    // --- TEACHER ROUTES ---
    Route::middleware(['role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [TeacherDashboardController::class, 'userCards'])->name('dashboard');
        Route::get('/student/{id}', [UserController::class, 'show'])->name('student.show');
        Route::get('/marks', [MarkController::class, 'index'])->name('marks.index');
        Route::get('/marks/create', [MarkController::class, 'create'])->name('marks.create');
        Route::post('/marks', [MarkController::class, 'store'])->name('marks.store');
        Route::get('/marks/{mark}/edit', [MarkController::class, 'edit'])->name('marks.edit');
        Route::put('/marks/{mark}', [MarkController::class, 'update'])->name('marks.update');
        Route::delete('/marks/{mark}', [MarkController::class, 'destroy'])->name('marks.destroy');
    });

    // --- STUDENT ROUTES ---
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'academicReport'])->name('dashboard');
//        Route::get('/marks', [DashboardController::class, 'viewMarks'])->name('marks');
        Route::get('/subjects', [StudentDashboardController::class, 'viewSubjects'])->name('subjects');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
