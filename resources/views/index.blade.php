@extends('layouts.master')

@section('content')
    @include('layouts.header')
    @if(isset($authUser->name))
        <div class="dashboardContainer col-4">
            <div class="logo col-2">
                логотип
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @include('layouts.errors')
            <div class="formContainer">
                @include('uploadFileForm')
                @include('uploadDirectoryForm')
                @if(isset($directories->items))
                    @include('directoryItems')
                @endif
                @if(!empty($files->items))
                    @include('fileItems')
                @endif
            </div>
        </div>
    @endif
@endsection

{{--                <p class="textColor">no directories</p>--}}
