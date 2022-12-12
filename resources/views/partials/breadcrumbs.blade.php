@unless ($breadcrumbs->isEmpty())
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="breadcrumb-item text-dark"><a href=/?path={{$breadcrumb->pieces}}>{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item text-dark active">{{$breadcrumb->title}}</li>
                @endif
            @endforeach
        </ol>
    </nav>
@endunless

