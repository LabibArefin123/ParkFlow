<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Permission::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('guard_name', 'like', "%{$search}%");
            });
        }

        $permissions = $query
            ->withCount('roles')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Permission::count(),
            'web' => Permission::where('guard_name', 'web')->count(),
            'assigned' => Permission::has('roles')->count(),
            'unused' => Permission::doesntHave('roles')->count(),
        ];

        return view('parkflow.permissions.index', compact(
            'user',
            'permissions',
            'stats'
        ));
    }

    public function create()
    {
        $user = auth()->user();

        return view('parkflow.permissions.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'guard_name' => 'required|string|max:255',
        ]);

        Permission::create($validated);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission)
    {
        $user = auth()->user();

        $permission->load('roles');

        return view('parkflow.permissions.show', compact(
            'user',
            'permission'
        ));
    }

    public function edit(Permission $permission)
    {
        $user = auth()->user();

        return view('parkflow.permissions.edit', compact(
            'user',
            'permission'
        ));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|string|max:255',
        ]);

        $permission->update($validated);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles()->exists()) {
            return redirect()
                ->route('permissions.index')
                ->with('error', 'This permission cannot be deleted because it is assigned to one or more roles.');
        }

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
