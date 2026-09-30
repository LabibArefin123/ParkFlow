@extends('parkflow.layouts.app')

@section('title', 'Edit Permission')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/edit_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/edit_page/permission_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/edit_page/permission_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/edit_page/permission_info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/edit_page/permission_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/edit_page/permission_resp.css') }}">
@endpush

@section('content')
    <div class="permission-header">
        <div>
            <div class="permission-eyebrow"> <i class="fa-solid fa-key"></i>
                Access Control </div>


            <h1>Edit Permission</h1>

            <p>Update this capability and keep ParkFlow access control organized.</p>
        </div>

        <a href="{{ route('permissions.index') }}" class="permission-secondary-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>
    </div>

    <div class="permission-form-panel">
        <form action="{{ route('permissions.update', $permission) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="permission-form-header">
                <div class="permission-form-icon permission-icon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>

                <div>
                    <h2>Permission Details</h2>
                    <p>Modify the capability name or authentication guard.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="permission-error">
                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="permission-form-grid">
                <div class="permission-field">
                    <label for="name">
                        Permission Name
                        <span>*</span>
                    </label>

                    <div class="permission-input">
                        <i class="fa-solid fa-key"></i>

                        <input type="text" id="name" name="name" value="{{ old('name', $permission->name) }}"
                            placeholder="e.g. parking_spots.create" required>
                    </div>

                    <small>
                        Use a clear action-based permission name.
                    </small>
                </div>

                <div class="permission-field">
                    <label for="guard_name">
                        Guard Name
                        <span>*</span>
                    </label>

                    <div class="permission-input">
                        <i class="fa-solid fa-shield-halved"></i>

                        <select id="guard_name" name="guard_name" required>
                            <option value="web"
                                {{ old('guard_name', $permission->guard_name) === 'web' ? 'selected' : '' }}>
                                web
                            </option>
                        </select>
                    </div>

                    <small>
                        ParkFlow uses the web authentication guard.
                    </small>
                </div>
            </div>

            <div class="permission-info">
                <div class="permission-info-icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>

                <div>
                    <strong>Permission management</strong>
                    <p>
                        Changes to this permission may affect roles that currently use it.
                        Review role assignments before making major changes.
                    </p>
                </div>
            </div>

            <div class="permission-form-footer">
                <a href="{{ route('permissions.show', $permission) }}" class="permission-secondary-btn">
                    <i class="fa-solid fa-eye"></i>
                    View Permission
                </a>

                <button type="submit" class="permission-primary-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Permission
                </button>
            </div>
        </form>
    </div>

@endsection
