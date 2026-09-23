@extends('parkflow.layouts.app')

@section('title', 'System Users')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/index_page/user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/index_page/user_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/index_page/user_panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/index_page/user_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/index_page/user_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/index_page/user_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-users"></i>
                    Administration
                </div>

                <h1>System Users</h1>

                <p>
                    Manage ParkFlow users and their access roles.
                </p>
            </div>

            <a href="{{ route('users.create') }}" class="rp-primary-btn">
                <i class="fa-solid fa-user-plus"></i>
                Add System User
            </a>
        </div>

        <div class="rp-stat-grid">

            <div class="rp-stat-card">
                <div class="rp-stat-icon blue">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>
                    <span>Total Users</span>
                    <strong>{{ number_format($stats['total']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon green">
                    <i class="fa-solid fa-user-check"></i>
                </div>

                <div>
                    <span>Assigned Users</span>
                    <strong>{{ number_format($stats['assigned']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon amber">
                    <i class="fa-solid fa-user-slash"></i>
                </div>

                <div>
                    <span>Unassigned</span>
                    <strong>{{ number_format($stats['unassigned']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon purple">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <div>
                    <span>Available Roles</span>
                    <strong>{{ number_format($stats['roles']) }}</strong>
                </div>
            </div>

        </div>

        <div class="rp-panel">

            <div class="rp-panel-header">

                <div>
                    <h2>
                        <i class="fa-solid fa-users-gear"></i>
                        User Directory
                    </h2>

                    <p>
                        View and manage registered ParkFlow system users.
                    </p>
                </div>

                <form action="{{ route('users.index') }}" method="GET" class="rp-user-filters">

                    <div class="rp-search">
                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input type="search" name="search" value="{{ request('search') }}" placeholder="Search users...">
                    </div>

                    <select name="role" class="rp-filter-select">
                        <option value="">All Roles</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="rp-filter-btn">
                        <i class="fa-solid fa-filter"></i>
                    </button>

                </form>

            </div>

            <div class="rp-table-wrap">

                <table class="rp-table">

                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th class="rp-action-head">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $systemUser)

                            <tr>

                                <td>
                                    <span class="rp-sl">
                                        {{ $users->firstItem() + $loop->index }}
                                    </span>
                                </td>

                                <td>

                                    <div class="rp-name-cell">

                                        <div class="rp-user-avatar">
                                            {{ strtoupper(substr($systemUser->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <strong>
                                                {{ $systemUser->name }}
                                            </strong>

                                            @if ($systemUser->id === auth()->id())
                                                <small class="rp-current-user">
                                                    <i class="fa-solid fa-circle"></i>
                                                    You
                                                </small>
                                            @else
                                                <small>
                                                    User #{{ $systemUser->id }}
                                                </small>
                                            @endif
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    <span class="rp-email">
                                        {{ $systemUser->email }}
                                    </span>
                                </td>

                                <td>
                                    @forelse($systemUser->roles as $role)
                                        <span class="rp-role-badge">
                                            <i class="fa-solid fa-user-shield"></i>
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="rp-unassigned">
                                            <i class="fa-solid fa-minus"></i>
                                            No Role
                                        </span>
                                    @endforelse
                                </td>
                                <td>
                                    <span class="rp-date">
                                        {{ $systemUser->created_at?->format('d M Y') ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="rp-actions">
                                        <a href="{{ route('users.show', $systemUser) }}" class="rp-action view"
                                            title="View">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>

                                        <a href="{{ route('users.edit', $systemUser) }}" class="rp-action edit"
                                            title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        @if ($systemUser->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $systemUser) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="rp-action delete" title="Delete">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="rp-empty">
                                        <div class="rp-empty-icon">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <h3>No users found</h3>
                                        <p>No system users match your current search.</p>
                                        <a href="{{ route('users.create') }}" class="rp-primary-btn">
                                            <i class="fa-solid fa-user-plus"></i>
                                            Add System User
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="rp-pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
