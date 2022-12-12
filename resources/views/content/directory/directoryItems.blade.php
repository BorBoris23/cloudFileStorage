@foreach($content['directories'] as $directory)
    <div class="fileContainer">
        <div class="actionButton">
            <div class="btn-group">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">...</button>
                <form method="POST" class="workToDirectoryForm dropdown-menu" action="/renameDirectory">
                    @csrf
                    <input class="fileInput" type="hidden" name="pathTo" value="{{$directory->pathTo}}">
                    <input class="fileInput" type="text" name="newDirectoryName" value="{{$directory->name}}">
                    <input class="fileInput" type="hidden" name="oldDirectoryName" value="{{old('newFileName', $directory->name)}}">
                    <button id="updateButton" type="submit" class="dropdown-item renameDirectoryButton">Rename directory</button>
                </form>
            </div>
        </div>
        <img src="{{ URL('img/3d_documents_folder_20533.png') }}" class="fileImg">
        <div class="fileTextContainer">
            <a class="fileText" href="/?path={{$directory->pathToSubDirectory}}">{{$directory->name}}</a>
        </div>
    </div>
@endforeach

