@extends('parkflow.layouts.app')

@section('title', 'Show Parking Location')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/show_page/parking_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/show_page/parking_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/show_page/parking_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/show_page/parking_switch.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/show_page/parking_footer.css') }}">
    @include('parkflow.parking_locations.partials.show_page.header')
    <div class="show-location-card">
        @include('parkflow.parking_locations.partials.show_page.part_1')
        @include('parkflow.parking_locations.partials.show_page.part_2')
        @include('parkflow.parking_locations.partials.show_page.part_3')
    </div>
@endsection
