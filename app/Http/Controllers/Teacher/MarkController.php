<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Subject;
use App\Models\User;
use App\Enum\UserRole;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marks = Mark::with(['student', 'subject'])->get();
        $students = User::where('role', UserRole::Student)->get();
        $subjects = Subject::all();
        return view('teacher.marks.index', compact('marks', 'students', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', UserRole::Student)->get();
        $subjects = Subject::all();
        return view('teacher.marks.create', compact('students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'mark' => ['required', 'numeric', 'min:0', 'max:20'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        Mark::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'mark' => $request->mark,
            'note' => $request->note,
        ]);

        return redirect()->route('teacher.marks.index')->with('Success', 'Mark created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mark = Mark::with(['student', 'subject'])->findOrFail($id);
        return view('teacher.marks.show', compact('mark'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mark = Mark::findOrFail($id);
        $students = User::where('role', UserRole::Student)->get();
        $subjects = Subject::all();
        return view('teacher.marks.edit', compact('mark', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mark = Mark::findOrFail($id);

        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'mark' => ['required', 'numeric', 'min:0', 'max:20'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $mark->update([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'mark' => $request->mark,
            'note' => $request->note,
        ]);

        return redirect()->route('teacher.marks.index')->with('Success', 'Mark updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mark = Mark::findOrFail($id);
        $mark->delete();

        return redirect()->route('teacher.marks.index')->with('Success', 'Mark deleted successfully.');
    }
}
