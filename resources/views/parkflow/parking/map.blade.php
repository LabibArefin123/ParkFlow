@extends('parkflow.layouts.app')

@section('title', 'Parking Map')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_spots.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_resp.css') }}">
@endpush

@section('content')
    <div class="parking-map-page">
        {{-- Header Part --}}
        @include('parkflow.parking.partials.header')
        {{-- Stats Part --}}
        @include('parkflow.parking.partials.part_1')
        {{-- Parking Overview Box Part --}}
        @include('parkflow.parking.partials.part_2')
    </div>
    @include('parkflow.parking.partials.part_3')
    <script src="{{ asset('js/parkflow/parking_map.js') }}"></script>
@endsection
