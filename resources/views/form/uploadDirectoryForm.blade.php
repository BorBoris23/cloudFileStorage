<form method="POST" class="uploadForm directoryForm" action="/uploadDirectory" enctype="multipart/form-data">
    @csrf
    <div class="directoriesArea">
        <input type="file" name="directoryToUpload[]" class="directoryHidden" webkitdirectory multiple>
    </div>
    <input type="hidden" name="folderName" class="folderName" value="">
    <input type="text" name="directory" class="hidden" value="{{Session::get('rootDirectory')}}">
    <div class="helpText">
        <small id="emailHelp" class="form-text textColor">Move the directory to upload to the cloud.</small>
    </div>
    <div class="uploadContainerButton">
        <button type="submit" class="btn btn-secondary submitColor">Upload directory</button>
    </div>
</form>
