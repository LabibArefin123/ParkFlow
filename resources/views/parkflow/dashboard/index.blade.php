@extends('parkflow.layouts.app')

@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_trans.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_session.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_resp.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="parkflow-dashboard">
            @include('parkflow.dashboard.partials.part_1')
            @include('parkflow.dashboard.partials.part_2')
            
            <div class="dashboard-grid">
                @include('parkflow.dashboard.partials.part_3a')
                @include('parkflow.dashboard.partials.part_3b')
            </div>
            @include('parkflow.dashboard.partials.part_4')
            @include('parkflow.dashboard.partials.part_5')
        </div>
    </div>
@endsection
