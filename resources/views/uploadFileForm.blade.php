<form method="POST" action="/files" enctype="multipart/form-data">
    @csrf
    <div class="filesArea">
        <input type="file" name="filesToUpload[]" class="filesHidden" multiple>
    </div>
    <input type="text" name="directory" class="hidden" value="{{$rootDirectory}}">
    <div class="helpText">
        <small id="emailHelp" class="form-text textColor">Move the file to upload to the cloud.</small>
    </div>
    <div class="uploadContainerButton">
        <button type="submit" class="submitButton">Upload files</button>
    </div>
</form>
