@unless ($breadcrumbs->isEmpty())
{{--    {{dd($breadcrumbs)}}--}}
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item"><a href=/?path={{$breadcrumb->pieces}}>{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{$breadcrumb->title}}</li>
            @endif
        @endforeach
    </ol>
@endunless
