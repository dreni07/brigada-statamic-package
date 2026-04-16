<div class="relative bg-gray-900 text-white py-24 px-4"
     @if($section->backgroundImage)
     style="background-image: url('{{ $section->backgroundImage }}'); background-size: cover; background-position: center;"
     @endif
>
    @if($section->backgroundImage)
        <div class="absolute inset-0 bg-black/50"></div>
    @endif

    <div class="relative max-w-4xl mx-auto text-center">
        <{{ $section->headingTag }} class="text-4xl md:text-5xl font-bold mb-4">
            {{ $section->heading }}
        </{{ $section->headingTag }}>

        @if($section->subheading)
            <p class="text-xl md:text-2xl text-gray-300 mb-8">{{ $section->subheading }}</p>
        @endif

        @if($section->ctaButtonText && $section->ctaButtonUrl)
            <a href="{{ $section->ctaButtonUrl }}"
               class="inline-block bg-white text-gray-900 font-semibold px-8 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                {{ $section->ctaButtonText }}
            </a>
        @endif
    </div>
</div>
