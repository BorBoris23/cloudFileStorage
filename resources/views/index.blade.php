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
                <form method="POST" action="/" enctype="multipart/form-data">
                    @csrf
                    <div class="filesArea">
                        <input type="file" name="filesToUpload[]" class="filesHidden" multiple>
                    </div>
                    <input type="text" name="directory" class="hidden" value="{{$userDirectory}}">
                    <div class="helpText">
                        <small id="emailHelp" class="form-text textColor">Move the file to upload to the cloud.</small>
                    </div>
                    <div class="uploadContainerButton">
                        <button type="submit" class="submitButton">Upload files</button>
                        <a href="/usersFiles" class="submitButton myFilesButton">My files</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection



