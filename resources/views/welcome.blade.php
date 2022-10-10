@extends('layouts.master')

@section('content')
    @include('layouts.header')

    @if(isset(Auth::user()->name))
        @include('dashboard')
    @endif

@endsection


