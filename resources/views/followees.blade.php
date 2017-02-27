@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('partials.profile')
            </div>
            <div class="col-md-6">
                @include('partials.followees')
            </div>
            <div class="col-md-3">
                @include('partials.tags')
            </div>
        </div>
    </div>
@endsection
