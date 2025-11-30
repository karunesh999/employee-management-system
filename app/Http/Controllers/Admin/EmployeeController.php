<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('is_admin', false)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'string', 'min:6'],
            'phone'       => ['nullable', 'string', 'max:20'],
            'department'  => ['nullable', 'string', 'max:255'],
            'photo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $data['password'] = Hash::make($data['password']);
        $data['is_admin'] = false;

        User::create($data);

        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(User $user)
    {
        // only non-admin employees
        if ($user->is_admin) {
            abort(403);
        }

        return view('admin.employees.edit', ['employee' => $user]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->is_admin) {
            abort(403);
        }

        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password'    => ['nullable', 'string', 'min:6'],
            'phone'       => ['nullable', 'string', 'max:20'],
            'department'  => ['nullable', 'string', 'max:255'],
            'photo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->is_admin) {
            abort(403);
        }

        $user->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
    }
}
