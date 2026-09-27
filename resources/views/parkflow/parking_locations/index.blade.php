@extends('parkflow.layouts.app')

@section('title', 'Parking Location')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_alert.css') }}">
    @include('parkflow.parking_locations.partials.index_page.header')
    @include('parkflow.parking_locations.partials.index_page.part_1')
    @include('parkflow.parking_locations.partials.index_page.part_2')
@endsection
