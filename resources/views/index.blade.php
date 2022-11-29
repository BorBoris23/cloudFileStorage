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
                @if(!empty($content['directories']))
                    {{ Breadcrumbs::render('toDirectory', $content['directories']) }}
                @elseif(!empty($content['files']))
                    {{ Breadcrumbs::render('toDirectory', $content['files']) }}
                @endif
                @if(!empty($content['files']))
                    @include('fileItems')
                @endif
                @if(!empty($content['directories']))
                     @include('directoryItems')
                @endif
            </div>
        </div>
    @endif
@endsection
