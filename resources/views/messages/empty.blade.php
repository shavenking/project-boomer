{{-- $header, $message, $url --}}
<div class="ui message">
    <div class="header">
        {{ $header }}
    </div>
    @if (!isset($message) || empty($message))
        <p><a href="{{ $url }}">請點我新增</a></p>
    @else
        <p>{{ $message }}<a href="{{ $url }}">請點我新增</a></p>
    @endif

</div>
