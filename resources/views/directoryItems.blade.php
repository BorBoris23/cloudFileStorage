@foreach($content['directories'] as $directory)
    <div class="filesListContainer">
        <div class="fileFormContainer">
            <a class="directoryInput" href="/?path={{$directory->pathToSubDirectory}}">{{$directory->name}}</a>
            <button id="updateButton" type="submit" class="renameDirectoryButton updateButton btn btn-secondary">Rename directory</button>
            @include('directoryRenameForm')
        </div>
    </div>
@endforeach
