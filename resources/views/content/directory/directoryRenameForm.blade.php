<div class="hiddenFormContainer hide">
    <form method="POST" class="workToDirectoryForm" action="/renameDirectory">
        @csrf
        <input class="fileInput" type="hidden" name="pathTo" value="{{$directory->pathTo}}">
        <input class="fileInput" type="text" name="newDirectoryName" value="{{$directory->name}}">
        <input class="fileInput" type="hidden" name="oldDirectoryName" value="{{old('newFileName', $directory->name)}}">
        <button type="submit" class="renameButton btn btn-secondary">Rename</button>
    </form>
    <button type="submit" class="cancelButton btn btn-secondary">Cancel</button>
</div>

