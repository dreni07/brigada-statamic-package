<div class="py-16 px-4">
    <div class="max-w-4xl mx-auto">
        @if($section->sectionHeading)
            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-4 text-center">
                {{ $section->sectionHeading }}
            </{{ $section->headingTag }}>
        @endif

        @if($section->sectionDescription)
            <p class="text-lg text-gray-600 mb-10 text-center">{{ $section->sectionDescription }}</p>
        @endif

        <div class="relative aspect-video rounded-lg overflow-hidden bg-black shadow-lg">
            @if($section->source === 'file' && $section->fileUrl)
                <video
                    class="w-full h-full object-cover"
                    @if($section->poster) poster="{{ $section->poster }}" @endif
                    @if($section->autoplay) autoplay @endif
                    @if($section->loop) loop @endif
                    @if($section->muted || $section->autoplay) muted @endif
                    playsinline
                    controls
                >
                    <source src="{{ $section->fileUrl }}">
                    Your browser does not support the video tag.
                </video>
            @elseif($section->embedUrl)
                <iframe
                    src="{{ $section->embedUrl }}"
                    class="absolute inset-0 w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                    loading="lazy"
                    title="{{ $section->sectionHeading ?? 'Embedded video' }}"
                ></iframe>
            @endif
        </div>
    </div>
</div>
