<div class="content d-flex flex-wrap">
    @if(!empty($content['directories']))
        @include('content.directory.directoryItems')
    @endif
    @if(!empty($content['files']))
        @include('content.file.fileItems')
    @endif
</div>
