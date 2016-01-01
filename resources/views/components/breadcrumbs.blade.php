{{-- $breadcrumbs --}}

@foreach ($breadcrumbs as $text => $url)
    @if (!is_null($url))
        <a href="{{ $url }}" class="section">{{ $text }}</a>
        <i class="right chevron icon divider"></i>
    @else
        <div class="active section">{{ $text }}</div>
    @endif
@endforeach
