@extends('parkflow.layouts.app')

@section('title', 'Add Permission')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/create_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/create_page/permission_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/create_page/permission_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/create_page/permission_info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/create_page/permission_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/create_page/permission_resp.css') }}">
@endpush
@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-key"></i>
                    Access Control
                </div>
                <h1>Add Permission</h1>
                <p>Create a new capability for ParkFlow roles.</p>
            </div>

            <a href="{{ route('permissions.index') }}" class="rp-secondary-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="rp-form-panel">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf

                <div class="rp-form-header">
                    <div class="rp-form-icon permission-icon">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div>
                        <h2>Permission Details</h2>
                        <p>Define a single capability that can later be assigned to a role.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="rp-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="rp-form-grid">
                    <div class="rp-field">
                        <label for="name">Permission Name <span>*</span> </label>

                        <div class="rp-input">
                            <i class="fa-solid fa-key"></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="e.g. parking_spots.create" required>
                        </div>

                        <small>Use a clear action-based name such as parking_spots.create </small>
                    </div>

                    <div class="rp-field">
                        <label for="guard_name">Guard Name <span>*</span> </label>

                        <div class="rp-input">
                            <i class="fa-solid fa-shield-halved"></i>
                            <select id="guard_name" name="guard_name" required>
                                <option value="web" {{ old('guard_name', 'web') === 'web' ? 'selected' : '' }}>
                                    web
                                </option>
                            </select>
                        </div>

                        <small>ParkFlow uses the web authentication guard.</small>
                    </div>
                </div>

                <div class="rp-form-footer">
                    <a href="{{ route('permissions.index') }}" class="rp-secondary-btn">
                        Cancel
                    </a>

                    <button type="submit" class="rp-primary-btn">
                        <i class="fa-solid fa-check"></i>
                        Create Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
