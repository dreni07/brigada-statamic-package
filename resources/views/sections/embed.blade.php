<div class="py-12 px-4">
    <div class="max-w-5xl mx-auto">
        @if($section->sectionHeading)
            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-8 text-center">
                {{ $section->sectionHeading }}
            </{{ $section->headingTag }}>
        @endif

        @if($section->mode === 'iframe' && $section->iframeUrl)
            <div class="w-full overflow-hidden rounded-lg border border-gray-200 bg-white">
                <iframe
                    src="{{ $section->iframeUrl }}"
                    title="{{ $section->iframeTitle ?? $section->sectionHeading ?? 'Embedded content' }}"
                    class="w-full block"
                    style="height: {{ $section->iframeHeight }}px;"
                    frameborder="0"
                    loading="lazy"
                ></iframe>
            </div>
        @elseif($section->mode === 'html' && $section->rawHtml)
            <div class="embed-html">
                {!! $section->rawHtml !!}
            </div>
        @endif
    </div>
</div>
