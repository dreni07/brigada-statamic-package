@php
    $widthClass = match($section->maxWidth) {
        'narrow' => 'max-w-2xl',
        'wide' => 'max-w-5xl',
        default => 'max-w-3xl',
    };
@endphp

<div class="{{ $widthClass }} mx-auto">
    @if($section->format === 'raw_html')
        {!! $section->htmlContent !!}
    @else
        <div class="prose prose-lg max-w-none">
            {!! $section->htmlContent !!}
        </div>
    @endif
</div>
