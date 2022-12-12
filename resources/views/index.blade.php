@extends('layouts.master')

@section('content')
    @include('layouts.header')
    @if(isset($authUser->name))
        <div class="col-12 min-vh-100 dashboardContainer">
            @include('dashboardContainer')
            @include('breadcrumbContainer')
            @include('content.contentItems')
        </div>
    @endif
@endsection


