@extends('parkflow.layouts.app')

@section('title', 'Roles')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/index_page/role_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/index_page/role_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/index_page/role_panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/index_page/role_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/index_page/role_pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/index_page/role_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-user-shield"></i>
                    Access Control
                </div>
                <h1>Roles</h1>
                <p>Group ParkFlow permissions into reusable access profiles.</p>
            </div>

            <a href="{{ route('roles.create') }}" class="rp-primary-btn">
                <i class="fa-solid fa-plus"></i>
                Add Role
            </a>
        </div>

        <div class="rp-stat-grid">
            <div class="rp-stat-card">
                <div class="rp-stat-icon blue">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <span>Total Roles</span>
                    <strong>{{ number_format($stats['total']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon green">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <span>Assigned Roles</span>
                    <strong>{{ number_format($stats['assigned']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon amber">
                    <i class="fa-solid fa-user-slash"></i>
                </div>
                <div>
                    <span>Unused Roles</span>
                    <strong>{{ number_format($stats['unused']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon purple">
                    <i class="fa-solid fa-key"></i>
                </div>
                <div>
                    <span>Permissions</span>
                    <strong>{{ number_format($stats['permissions']) }}</strong>
                </div>
            </div>
        </div>

        <div class="rp-panel">

            <div class="rp-panel-header">
                <div>
                    <h2>
                        <i class="fa-solid fa-user-shield"></i>
                        Role List
                    </h2>
                    <p>Manage access profiles and their assigned permissions.</p>
                </div>

                <form action="{{ route('roles.index') }}" method="GET" class="rp-search">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Search roles...">
                </form>
            </div>

            <div class="rp-table-wrap">
                <table class="rp-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>Guard</th>
                            <th>Permissions</th>
                            <th>Users</th>
                            <th>Created</th>
                            <th class="rp-action-head">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>
                                    <span class="rp-sl">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <td>
                                    <div class="rp-name-cell">
                                        <div class="rp-item-icon role-icon">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </div>

                                        <div>
                                            <strong>{{ $role->name }}</strong>
                                            <small>Role #{{ $role->id }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="rp-guard">{{ $role->guard_name }}</span>
                                </td>

                                <td>
                                    <span class="rp-count">
                                        {{ $role->permissions_count }}
                                        {{ Str::plural('permission', $role->permissions_count) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="rp-count">
                                        {{ $role->users_count }}
                                        {{ Str::plural('user', $role->users_count) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="rp-date">
                                        {{ $role->created_at?->format('d M Y') ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="rp-actions">
                                        <a href="{{ route('roles.show', $role) }}" class="rp-action view" title="View">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>

                                        <a href="{{ route('roles.edit', $role) }}" class="rp-action edit" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="rp-action delete" title="Delete">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="rp-empty">
                                        <div class="rp-empty-icon">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </div>
                                        <h3>No roles found</h3>
                                        <p> Create your first ParkFlow role to organize permissions.</p>
                                        <a href="{{ route('roles.create') }}" class="rp-primary-btn">
                                            <i class="fa-solid fa-plus"></i>
                                            Add Role
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($roles->hasPages())
                <div class="rp-pagination">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
