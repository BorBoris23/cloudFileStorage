<div class="directoryName">
    {{$directory}}
</div>
@forelse($files as $file)
    <div class="filesListContainer">
        <form method="POST" class="workToFileForm" action="/workToFileForm">
            @csrf
            <input class="fileInput" type="hidden" name="pathToFile" value="{{$file}}">
            <input class="fileInput" type="text" name="newFileName" value="{{str_replace($directory, '', $file)}}">
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
    <p class="textColor">no files</p>
@endforelse




