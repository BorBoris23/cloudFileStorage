@foreach($content['files'] as $file)
    <div class="filesListContainer">
        <form method="POST" class="workToFileForm" action="/workToFile">
            @csrf
            <div class="fileFormContainer">
                <input class="fileInput" type="hidden" name="pathTo" value="{{$file->pathTo}}">
                <input class="fileInput" type="text" name="newFileName" value="{{$file->name}}">
                <input class="fileInput" type="hidden" name="oldFileName" value="{{old('newFileName', $file->name)}}">
                <div class="containerUploadButton">
                    <button id="uploadButton" type="submit" class="uploadButton"></button>
                </div>
                <button id="deleteButton" type="submit" class="deleteButton btn btn-danger">Delete</button>
                <button id="updateButton" type="submit" class="updateButton btn btn-secondary">Rename</button>
            </div>
        </form>
    </div>
@endforeach




