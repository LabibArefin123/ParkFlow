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
    <link rel="stylesheet"  href="{{ asset('css/custom_backend/parking_session/index_page/modal_part/session_modal.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/custom_backend/parking_session/index_page/modal_part/session_modal_header.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/custom_backend/parking_session/index_page/modal_part/session_modal_content.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/custom_backend/parking_session/index_page/modal_part/session_modal_footer.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/custom_backend/parking_session/index_page/modal_part/session_modal_resp.css') }}">
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
    <script src="{{ asset('js/parkflow/parking_sessions/parking_session_table.js') }}"></script>
    <script src="{{ asset('js/parkflow/parking_sessions/parking_session_modal.js') }}"></script>
    <script src="{{ asset('js/parkflow/parking_sessions/parking_session_filter.js') }}"></script>
    <script src="{{ asset('js/parkflow/parking_sessions/parking_session_init.js') }}"></script>
@endsection
