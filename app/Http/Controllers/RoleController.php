<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Role::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('guard_name', 'like', "%{$search}%");
            });
        }

        $roles = $query
            ->withCount(['permissions', 'users'])
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Role::count(),
            'assigned' => Role::has('users')->count(),
            'unused' => Role::doesntHave('users')->count(),
            'permissions' => Permission::count(),
        ];

        return view('parkflow.roles_page.index', compact(
            'user',
            'roles',
            'stats'
        ));
    }

    public function create()
    {
        $user = auth()->user();

        $permissions = Permission::orderBy('name')->get();

        return view('parkflow.roles_page.create', compact(
            'user',
            'permissions'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions(
                Permission::whereIn('id', $validated['permissions'])->get()
            );
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        $user = auth()->user();

        $permissions = Permission::orderBy('name')->get();

        $role->load([
            'permissions',
            'users',
        ]);

        return view('parkflow.roles_page.show', compact(
            'user',
            'role',
            'permissions'
        ));
    }

    public function edit(Role $role)
    {
        $user = auth()->user();

        $permissions = Permission::orderBy('name')->get();

        $role->load('permissions');

        $selectedPermissions = $role->permissions
            ->pluck('id')
            ->toArray();

        return view('parkflow.roles_page.edit', compact(
            'user',
            'role',
            'permissions',
            'selectedPermissions'
        ));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'guard_name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role->update([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        $role->syncPermissions(
            !empty($validated['permissions'])
                ? Permission::whereIn('id', $validated['permissions'])->get()
                : []
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'This role cannot be deleted because it is assigned to one or more users.');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
