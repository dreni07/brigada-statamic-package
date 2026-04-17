@props([
    'src' => null,
    'alt' => '',
    'width' => null,
    'height' => null,
    'loading' => 'lazy',
    'decoding' => 'async',
    'fetchpriority' => null,
    'sizes' => null,
    'srcset' => null,
    'placeholder' => null,
])

@php
    $placeholderStyle = $placeholder
        ? "background-image: url('{$placeholder}'); background-size: cover; background-position: center;"
        : null;
@endphp

@if($src)
<img
    src="{{ $src }}"
    alt="{{ $alt }}"
    loading="{{ $loading }}"
    decoding="{{ $decoding }}"
    @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
    @if($sizes) sizes="{{ $sizes }}" @endif
    @if($srcset) srcset="{{ $srcset }}" @endif
    {{ $attributes->merge($placeholderStyle ? ['style' => $placeholderStyle] : []) }}
>
@endif
