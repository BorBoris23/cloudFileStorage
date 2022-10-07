@extends('layouts.master')

@section('content')

    @if(isset(Auth::user()->name))

        <div class="header">
            <div class="infoContainer">
                <div class="btn btn-sm btn-outline-secondary textColor ">
                    {{Auth::user()->name}}
                </div>
                <div class="btn btn-sm btn-outline-secondary textColor ">
                    @include('auth.logout')
                </div>
            </div>
        </div>

        @include('dashboard')

    @else

        <x-guest-layout>
            <x-auth-card>

                <x-slot name="logo">
                    логотип
                </x-slot>
                    <div class="loginRegContainer">
                        <a class="mainButton" href="/login">Log in</a>
                        <a class="mainButton" href="/register">Sign up</a>
                    </div>
            </x-auth-card>
        </x-guest-layout>

    @endif

@endsection




{{--@extends('layouts.master')--}}

{{--@section('content')--}}
{{--    --}}
{{--    @--}}

{{--    <div class="header">--}}
{{--        <div class="infoContainer">--}}
{{--            <div class="btn btn-sm btn-outline-secondary textColor ">--}}
{{--                aaaaa--}}
{{--            </div>--}}
{{--            <div class="btn btn-sm btn-outline-secondary textColor ">--}}
{{--                <a href="/login">Log in</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <x-guest-layout>--}}
{{--        <x-auth-card>--}}
{{--            <x-slot name="logo">--}}

{{--            </x-slot>--}}

{{--                @guest--}}
{{--                    <a class="btn btn-sm btn-outline-secondary" href="/login">Log in</a>--}}
{{--                    <a class="btn btn-sm btn-outline-secondary" href="/register">Sign up</a>--}}
{{--                @else--}}
{{--                    --}}

{{--                    <div>--}}
{{--                        {{Auth::user()->name}}--}}
{{--                    </div>--}}

{{--                    @include('layouts.fileForm')--}}

{{--                @endguest--}}

{{--        </x-auth-card>--}}
{{--    </x-guest-layout>--}}

{{--@endsection--}}


