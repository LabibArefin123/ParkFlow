@extends('parkflow.layouts.app')

@section('title', 'Revenue')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_badges.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_paginate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_footer_responsive.css') }}">
    @include('parkflow.revenue.partials.header')
    @include('parkflow.revenue.partials.part_1')
    @include('parkflow.revenue.partials.part_2')
    @include('parkflow.revenue.partials.part_3')    
@endsection
