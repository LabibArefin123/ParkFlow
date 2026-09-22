@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_overview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_security.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_responsive.css') }}">
    <div class="parkflow-profile-page"> {{-- PAGE HEADER --}} <div class="profile-page-header">
            <div> <span class="profile-eyebrow"> <i class="fa-solid fa-user-shield"></i> Account Settings </span>
                <h1>My Profile</h1>
                <p> Manage your ParkFlow account information and security settings. </p>
            </div>
            <div class="profile-header-status"> <span class="profile-status-dot"></span> Account Active </div>
        </div>
        <div class="profile-grid">
            {{-- PROFILE OVERVIEW --}}
            @include('parkflow.profile_page.partials.part_1a')
            {{-- PERSONAL INFORMATION --}}
            @include('parkflow.profile_page.partials.part_1b')
            {{-- PASSWORD & SECURITY --}}
            @include('parkflow.profile_page.partials.part_2')
            {{-- SECURITY STATUS --}}
            @include('parkflow.profile_page.partials.part_3')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/parkflow/profile_page/password.js') }}"></script>
@endpush
