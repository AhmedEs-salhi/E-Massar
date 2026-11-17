<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('level')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::all();
        return view('admin.subjects.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'level_id' => ['nullable', 'integer', 'exists:levels,id'],
        ]);

        Subject::create([
            'title' => $request->title,
            'level_id' => $request->level_id,
        ]);

        return redirect()->route('admin.subjects.index')->with('Success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::with(['level', 'marks'])->findOrFail($id);
        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);
        $levels = Level::all();
        return view('admin.subjects.edit', compact('subject', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'level_id' => ['nullable', 'integer', 'exists:levels,id'],
        ]);

        $subject->update([
            'title' => $request->title,
            'level_id' => $request->level_id,
        ]);

        return redirect()->route('admin.subjects.index')->with('Success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('Success', 'Subject deleted successfully.');
    }
}
