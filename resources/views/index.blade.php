@extends('layouts.master')

@section('content')
    @include('layouts.header')
    <div class="col-12 min-vh-100 dashboardContainer">
        @if(isset($authUser->name))
            @include('dashboardContainer')
            @if(!empty($content['directories'] || !empty($content['files'])))
                @include('breadcrumbContainer')
            @endif
            @include('content.contentItems')
        @else
            <div class="logoImgContainer">
                <img src="{{ URL('img/logo.jpg') }}" class="logoImg">
            </div>
        @endif
    </div>
@endsection


