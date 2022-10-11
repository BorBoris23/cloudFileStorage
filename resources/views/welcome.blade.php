@extends('layouts.master')

@section('content')
    @include('layouts.header')

    @if(isset($authUser->name))
        @include('dashboard')
    @endif

@endsection


