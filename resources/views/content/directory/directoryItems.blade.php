@foreach($content['directories'] as $directory)
    <div class="fileContainer">
        <div class="actionButton">
            <div class="btn-group">
                <button id="dropdownMenuClickableInside" class="dropdown-toggle" type="button" data-bs-toggle="dropdown"  data-bs-auto-close="true" aria-expanded="false">...</button>
                <div class="workToFileForm dropdown-menu">
                    <form method="POST" class="workToDirectoryForm" aria-labelledby="defaultDropdown">
                        @csrf
                        <div class="renameDirectory">
                            <input class="fileInput renameDirectoryInput" type="text" name="newDirectoryName" value="{{$directory->name}}">
                            <input class="fileInput" type="hidden" name="pathTo" value="{{$directory->pathTo}}">
                            <input class="fileInput" type="hidden" name="oldDirectoryName" value="{{old('newFileName', $directory->name)}}">
                            <button type="submit" class="renameDirectoryButton dropdown-item">Rename</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <a href="/?path={{$directory->pathToSubDirectory}}"><img src="{{ Vite::asset('resources/images/3d_documents_folder_20533.png') }}" class="directoryImg"></a>
        <div class="fileTextContainer">
            <a class="fileText" href="/?path={{$directory->pathToSubDirectory}}">{{$directory->name}}</a>
        </div>
    </div>
@endforeach

