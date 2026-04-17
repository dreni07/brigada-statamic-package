@php
    $imageFirst = $section->imagePosition === 'left';
@endphp

<div class="py-16 px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
        <div class="{{ $imageFirst ? 'md:order-1' : 'md:order-2' }}">
            @if($section->image)
                <img src="{{ $section->image }}"
                     alt="{{ $section->imageAlt ?? $section->heading }}"
                     class="w-full h-auto rounded-lg shadow-md object-cover">
            @endif
        </div>

        <div class="{{ $imageFirst ? 'md:order-2' : 'md:order-1' }}">
            @if($section->subheading)
                <p class="text-sm font-semibold uppercase tracking-wide text-blue-600 mb-3">{{ $section->subheading }}</p>
            @endif

            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ $section->heading }}
            </{{ $section->headingTag }}>

            @if($section->htmlContent)
                <div class="prose prose-lg text-gray-700 max-w-none">
                    {!! $section->htmlContent !!}
                </div>
            @endif

            @if($section->button)
                @php
                    $buttonClasses = match($section->button->style) {
                        'secondary' => 'bg-gray-100 text-gray-900 hover:bg-gray-200',
                        'outline' => 'border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white',
                        default => 'bg-blue-600 text-white hover:bg-blue-700',
                    };
                @endphp
                <a href="{{ $section->button->url }}"
                   class="inline-block mt-6 font-semibold px-8 py-3 rounded-lg transition-colors {{ $buttonClasses }}">
                    {{ $section->button->text }}
                </a>
            @endif
        </div>
    </div>
</div>
