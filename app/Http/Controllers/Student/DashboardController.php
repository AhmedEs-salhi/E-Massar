<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Corresponds to viewMarks() in the UML diagram
    public function academicReport()
    {
        $student = Auth::user();
        // Load marks along with their subjects

        return view('student.dashboard', [
            'student' => $student
        ]);
    }

    // Corresponds to viewSubjects() in the UML diagram
    public function viewSubjects()
    {
        $student = Auth::user();
        // Get subjects matching the student's class level
        $levelId = $student->classe?->level_id ?? null;
        $subjects = \App\Models\Subject::where('level_id', $levelId)->get();

        return view('student.subjects', compact('subjects'));
    }
}
