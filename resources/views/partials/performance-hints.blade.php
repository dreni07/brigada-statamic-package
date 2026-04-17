@php
    $preconnects = config('cms-starter.performance.preconnect', []);
    $preloads = config('cms-starter.performance.preload', []);
@endphp

@foreach($preconnects as $hint)
    @if(!empty($hint['href']))
<link rel="preconnect" href="{{ $hint['href'] }}"@if(!empty($hint['crossorigin'])) crossorigin @endif>
@if(!empty($hint['dns_prefetch']))
<link rel="dns-prefetch" href="{{ $hint['href'] }}">
@endif
    @endif
@endforeach

@foreach($preloads as $hint)
    @if(!empty($hint['href']) && !empty($hint['as']))
<link
    rel="preload"
    href="{{ $hint['href'] }}"
    as="{{ $hint['as'] }}"
    @if(!empty($hint['type'])) type="{{ $hint['type'] }}" @endif
    @if(!empty($hint['crossorigin'])) crossorigin @endif
    @if(!empty($hint['fetchpriority'])) fetchpriority="{{ $hint['fetchpriority'] }}" @endif
    @if(!empty($hint['imagesrcset'])) imagesrcset="{{ $hint['imagesrcset'] }}" @endif
    @if(!empty($hint['imagesizes'])) imagesizes="{{ $hint['imagesizes'] }}" @endif
>
    @endif
@endforeach
