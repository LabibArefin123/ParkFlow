@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_stats/admin_stats_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_stats/admin_stats_icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_stats/admin_stats_content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_stats/admin_stats_variants.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_stats/admin_stats_resp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_resp.css') }}">
    @include('parkflow.administration.partials.header')
    @include('parkflow.administration.partials.part_1')
    <div class="admin-section-title">
        <h2>Management</h2>
        <p>Access the core ParkFlow management modules.</p>
    </div>
    @include('parkflow.administration.partials.part_2')
@endsection
