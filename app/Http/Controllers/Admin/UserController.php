<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\User;
use App\Enum\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function students() {
//        return response()->json(User::where('role', UserRole::Student)->get());
        return view(strtolower(Auth::user()->role->name) . '.students', [
            'students' => User::where('role', UserRole::Student)
                ->select('id', 'name', 'email', 'class_id')
                ->get()
        ]);
    }

    public function teachers() {
        return view(strtolower(Auth::user()->role->name) . '.teachers', [
            'teachers' => User::where('role', UserRole::Teacher)
                ->select('id', 'name', 'email', 'class_id')
                ->get()
        ]);
    }

    public function create() {
        return view(strtolower(Auth::user()->role->name) . '.add-user', [
            'classes' => Classe::select('id', 'title')->get(),
            'roles' => UserRole::cases(),
        ]);
    }

    public function store(Request $request) {
//        dd($request->request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'class_id' => ['required', 'integer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'class_id' => $request->class_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with(['Success' => 'Student Added Successfully']);
    }

    public function edit(Request $request, string $id) {
        return view(strtolower(Auth::user()->role->name) . '.edit-student', [
            'student' => User::where('id', $id)->first()
        ]);
    }

    public function show(string $id)
    {
        $user = User::where('id', $id)->first();
//        dd('show-' . strtolower($user->role->value));
        return view(strtolower(Auth::user()->role->name) . '.show-' . strtolower($user->role->value), [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();
//        dd($request->request);
        if (!$user) {
            return redirect()->back()->with(['Error' => 'Student not found']);
        }

        $validated_credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$id],
//            'class_id' => ['required', 'integer'],
        ]);

        $user->update($validated_credentials);

        return redirect()->back()->with(['Success' => 'Student Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->with(['Error' => 'Student not found']);
        }

        $user->delete();
        return redirect()->back()->with(['Success' => 'Student Deleted Successfully']);
    }
}
