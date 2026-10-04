@extends('parkflow.layouts.app')

@section('title', 'Parking Sessions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_status.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_resp.css') }}">
@endpush

@section('content')
    {{-- Header Part --}}
    @include('parkflow.parking_sessions.partials.index_page.header')
    {{-- Stat Part --}}
    @include('parkflow.parking_sessions.partials.index_page.part_1')
    {{-- Filter Part --}}
    @include('parkflow.parking_sessions.partials.index_page.part_2')
    {{-- Table Part --}}
    @include('parkflow.parking_sessions.partials.index_page.part_3')
    <script src="{{ asset('js/parkflow/parking_sessions.js') }}"></script>
@endsection
