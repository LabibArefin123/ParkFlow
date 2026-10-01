@extends('parkflow.layouts.app')

@section('title', 'Reports Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_panels.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_responsive.css') }}">
@endpush

@section('content')
    {{-- Header Part --}}
    @include('parkflow.reports.partials.header')
    {{-- Filter Part --}}
    @include('parkflow.reports.partials.part_1')
    {{-- Report Period Part --}}
    @include('parkflow.reports.partials.part_2')
    {{-- Stat Part --}}
    @include('parkflow.reports.partials.part_3')
    <div class="report-content-grid">
        {{-- Daily Revenue Part --}}
        @include('parkflow.reports.partials.part_4a')
        {{-- Session Status Part --}}
        @include('parkflow.reports.partials.part_4b')
    </div>

    <div class="report-content-grid">
        {{-- Vehicle Type Part --}}
        @include('parkflow.reports.partials.part_5a')
        {{-- Payment Method Part --}}
        @include('parkflow.reports.partials.part_5b')
    </div>

    {{-- Location Part --}}
    @include('parkflow.reports.partials.part_6')
    {{-- Recent Sessions Part --}}
    @include('parkflow.reports.partials.part_7')
@endsection
