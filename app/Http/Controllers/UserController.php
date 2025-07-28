<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only admin can access user management
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to access user management.');
        }

        $users = User::with(['courses', 'enrollments'])->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only admin can create users
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to create users.');
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only admin can create users
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to create users.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,teacher,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Only admin can view user details
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to view user details.');
        }

        $user->load(['courses', 'enrollments.course', 'enrolledCourses']);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Only admin can edit users
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to edit users.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Only admin can update users
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to update users.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,teacher,user',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Only admin can delete users
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to delete users.');
        }

        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
