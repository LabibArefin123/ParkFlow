<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = User::with('roles');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $roles = Role::orderBy('name')->get();

        $stats = [
            'total' => User::count(),
            'assigned' => User::has('roles')->count(),
            'unassigned' => User::doesntHave('roles')->count(),
            'roles' => Role::count(),
        ];

        return view('user_page.index', compact(
            'user',
            'users',
            'roles',
            'stats'
        ));
    }

    public function create()
    {
        $user = auth()->user();

        $roles = Role::orderBy('name')->get();

        return view('user_page.create', compact(
            'user',
            'roles'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|exists:roles,name',
        ]);

        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if (!empty($validated['role'])) {
            $newUser->assignRole($validated['role']);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $authUser = auth()->user();

        $user->load('roles', 'permissions');

        return view('user_page.show', compact(
            'authUser',
            'user'
        ));
    }

    public function edit(User $user)
    {
        $authUser = auth()->user();

        $roles = Role::orderBy('name')->get();

        $user->load('roles');

        $selectedRole = $user->roles->first()?->name;

        return view('user_page.edit', compact(
            'authUser',
            'user',
            'roles',
            'selectedRole'
        ));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|exists:roles,name',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        $user->syncRoles(
            !empty($validated['role'])
                ? [$validated['role']]
                : []
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
