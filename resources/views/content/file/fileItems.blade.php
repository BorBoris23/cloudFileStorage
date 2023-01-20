@foreach($content['files'] as $file)
    <div class="fileContainer">
        <div class="actionButton">
            <div class="btn-group">
                <button id="dropdownMenuClickableInside" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">...</button>
                <div class="workToFileForm dropdown-menu">
                    <input class="dropdown-item deleteFile" type="button" path="{{$file->pathTo}}" value="Delete">
                    <div class="btn-group">
                        <button id="defaultDropdown" type="submit" class="dropdown-item renameFileButton" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">Rename</button>
                        <form method="POST" class="workToFileForm dropdown-menu dropdown-menu-dark" aria-labelledby="defaultDropdown">
                            @csrf
                            <input class="renameInput" type="text" name="newFileName" value="{{$file->name}}">
                            <input class="fileInput" type="hidden" name="pathTo" value="{{$file->pathTo}}">
                            <input class="fileInput" type="hidden" name="oldFileName" value="{{old('newFileName', $file->name)}}">
                            <button type="submit" class="dropdown-item renameFile btn-dark">Ok</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ Vite::asset('resources/images/file.png') }}" class="fileImg" name="{{$file->name}}" path="{{$file->pathTo}}">
        <div class="fileTextContainer">
            <p class="fileText">{{$file->name}}</p>
        </div>
    </div>
@endforeach
