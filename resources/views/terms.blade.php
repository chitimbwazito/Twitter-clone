@extends('layout.layout')
@section('title')
Terms
@endsection

@section('content')
    <div class="row">
            @include('shared.left-sidebar')
        <div class="col-6">
            <h1>Terms</h1>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
