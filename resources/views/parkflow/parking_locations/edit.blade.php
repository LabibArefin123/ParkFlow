@extends('parkflow.layouts.app')

@section('title', 'Edit Parking Location')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_switch.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_footer.css') }}">
    @include('parkflow.parking_locations.partials.edit_page.header')
    @include('parkflow.parking_locations.partials.edit_page.form')
@endsection
