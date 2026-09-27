@extends('parkflow.layouts.app')

@section('title', 'Active Sessions')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_empty.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_responsive.css') }}">
    @include('parkflow.active_sessions.partials.header')
    @include('parkflow.active_sessions.partials.part_1')
    @include('parkflow.active_sessions.partials.part_2')
@endsection
