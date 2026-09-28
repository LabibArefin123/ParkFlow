@extends('parkflow.layouts.app')

@section('title', 'Parking Session Details')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_vehicle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_payment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_resp.css') }}">
    @include('parkflow.parking_sessions.partials.show_page.header')

    <div class="session-show-grid">
        <div class="session-main-column">
            {{-- Vehicle Info + Location Part --}}
            @include('parkflow.parking_sessions.partials.show_page.part_1')
            {{-- Session Timeline Part --}}
            @include('parkflow.parking_sessions.partials.show_page.part_2')
            {{-- Parking Info Part --}}
            @include('parkflow.parking_sessions.partials.show_page.part_3')
        </div>

        <div class="session-side-column">
            {{-- Vehicle Owner Info Part --}}
            @include('parkflow.parking_sessions.partials.show_page.part_4')
            {{-- Payment Info Part --}}
            @include('parkflow.parking_sessions.partials.show_page.part_5')
            {{-- Back to Session Part --}}
            @include('parkflow.parking_sessions.partials.show_page.part_6')
        </div>
    </div>
@endsection
