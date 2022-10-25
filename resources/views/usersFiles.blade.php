@extends('layouts.master')

@section('content')
    @include('layouts.header')
    <div class="dashboardContainer col-4">
        <div class="logo col-2">
            логотип
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="formContainer textColor">
            @forelse($files as $file)
                <div class="filesListContainer">
                    <form method="POST" class="workToFileForm" action="/workToFileForm">
                        @csrf
                        <input class="fileInput" type="hidden" name="pathToFile" value="{{$file}}">
                        <input class="fileInput" type="text" name="newFileName" value="{{str_replace($userDirectory, '', $file)}}">
                        <div class="buttonContainer">
                            <div class="containerUploadButton">
                                <button id="uploadButton" type="submit" class="uploadButton"></button>
                            </div>
                            <button id="deleteButton" type="submit" class="deleteButton">Delete file</button>
                            <button id="updateButton" type="submit" class="updateButton">Update file</button>
                        </div>
                    </form>
                </div>
            @empty
                <p>no files</p>
            @endforelse
        </div>
    </div>
@endsection

