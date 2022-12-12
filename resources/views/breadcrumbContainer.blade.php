<div class="breadcrumbsContainer">
    @if(!empty($content['directories']))
        {{ Breadcrumbs::render('toDirectory', $content['directories']) }}
    @elseif(!empty($content['files']))
        {{ Breadcrumbs::render('toDirectory', $content['files']) }}
    @endif
</div>



