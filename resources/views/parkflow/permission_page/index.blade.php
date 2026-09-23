@extends('parkflow.layouts.app')

@section('title', 'Permissions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/index_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/index_page/permission_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/index_page/permission_panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/index_page/permission_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/index_page/permission_pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/index_page/permission_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-key"></i>
                    Access Control
                </div>
                <h1>Permissions</h1>
                <p>Manage the individual capabilities available across ParkFlow.</p>
            </div>

            <a href="{{ route('permissions.create') }}" class="rp-primary-btn">
                <i class="fa-solid fa-plus"></i>
                Add Permission
            </a>
        </div>

        <div class="rp-stat-grid">
            <div class="rp-stat-card">
                <div class="rp-stat-icon blue">
                    <i class="fa-solid fa-key"></i>
                </div>
                <div>
                    <span>Total Permissions</span>
                    <strong>{{ number_format($stats['total']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon green">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <span>Web Guard</span>
                    <strong>{{ number_format($stats['web']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon purple">
                    <i class="fa-solid fa-link"></i>
                </div>
                <div>
                    <span>Assigned</span>
                    <strong>{{ number_format($stats['assigned']) }}</strong>
                </div>
            </div>

            <div class="rp-stat-card">
                <div class="rp-stat-icon amber">
                    <i class="fa-solid fa-unlink"></i>
                </div>
                <div>
                    <span>Unused</span>
                    <strong>{{ number_format($stats['unused']) }}</strong>
                </div>
            </div>
        </div>

        <div class="rp-panel">
            <div class="rp-panel-header">
                <div>
                    <h2>
                        <i class="fa-solid fa-list-check"></i>
                        Permission List
                    </h2>
                    <p>Define what users and roles are allowed to do.</p>
                </div>

                <form action="{{ route('permissions.index') }}" method="GET" class="rp-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" name="search" value="{{ request('search') }}"
                        placeholder="Search permissions...">
                </form>
            </div>

            <div class="rp-table-wrap">
                <table class="rp-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Permission</th>
                            <th>Guard</th>
                            <th>Roles</th>
                            <th>Created</th>
                            <th class="rp-action-head">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>
                                    <span class="rp-sl">
                                        {{ $permissions->firstItem() + $loop->index }}
                                    </span>
                                </td>

                                <td>
                                    <div class="rp-name-cell">
                                        <div class="rp-item-icon permission-icon">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $permission->name }}</strong>
                                            <small>Permission #{{ $permission->id }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="rp-guard"> {{ $permission->guard_name }}</span>
                                </td>

                                <td>
                                    <span class="rp-count">
                                        {{ $permission->roles_count }}
                                        {{ Str::plural('role', $permission->roles_count) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="rp-date">{{ $permission->created_at?->format('d M Y') ?? '-' }}</span>
                                </td>

                                <td>
                                    <div class="rp-actions">
                                        <a href="{{ route('permissions.show', $permission) }}" class="rp-action view"
                                            title="View">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>

                                        <a href="{{ route('permissions.edit', $permission) }}" class="rp-action edit"
                                            title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST"
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
                                <td colspan="6">
                                    <div class="rp-empty">
                                        <div class="rp-empty-icon">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                        <h3>No permissions found</h3>
                                        <p>Create your first ParkFlow permission to start managing access.</p>
                                        <a href="{{ route('permissions.create') }}" class="rp-primary-btn">
                                            <i class="fa-solid fa-plus"></i>
                                            Add Permission
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($permissions->hasPages())
                <div class="rp-pagination"> {{ $permissions->links() }} </div>
            @endif
        </div>
    </div>
@endsection
