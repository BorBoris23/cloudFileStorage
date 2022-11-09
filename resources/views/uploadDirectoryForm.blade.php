<form method="POST" class="directoryForm" action="/directory" enctype="multipart/form-data">
    @csrf
    <div class="filesArea">
        <input type="file" name="directoryToUpload[]" class="directoryHidden" webkitdirectory multiple>
    </div>
    <input type="hidden" name="folderName" class="folderName" value="">
    <input type="text" name="directory" class="hidden" value="{{$rootDirectory}}">
    <div class="helpText">
        <small id="emailHelp" class="form-text textColor">Move the directory to upload to the cloud.</small>
    </div>
    <div class="uploadContainerButton">
        <button type="submit" class="submitButton">Upload directory</button>
    </div>
</form>
