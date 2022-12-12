@foreach($content['files'] as $file)
    <div class="fileContainer">
        <div class="actionButton">
            <div class="btn-group">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">...</button>
                <form method="POST" class="workToFileForm dropdown-menu" action="/workToFile">
                    @csrf
                    <input class="fileInput" type="text" name="newFileName" value="{{$file->name}}">
                    <input class="fileInput" type="hidden" name="pathTo" value="{{$file->pathTo}}">
                    <input class="fileInput" type="hidden" name="oldFileName" value="{{old('newFileName', $file->name)}}">
                    <button id="uploadButton" type="submit" class="dropdown-item">Upload</button>
                    <button id="deleteButton" type="submit" class="dropdown-item deleteButton">Delete</button>
                    <button id="updateButton" type="submit" class="dropdown-item renameFileButton">Rename</button>
                </form>
            </div>
        </div>
        <img src="{{ URL('img/file.png') }}" class="fileImg">
        <div class="fileTextContainer">
            <p class="fileText">{{$file->name}}</p>
        </div>
    </div>
@endforeach



