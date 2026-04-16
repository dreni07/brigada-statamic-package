<div class="bg-blue-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <{{ $section->headingTag }} class="text-3xl font-bold mb-4">
            {{ $section->heading }}
        </{{ $section->headingTag }}>

        @if($section->description)
            <p class="text-xl text-blue-100 mb-8">{{ $section->description }}</p>
        @endif

        @if($section->button)
            @php
                $buttonClasses = match($section->button->style) {
                    'secondary' => 'bg-white text-blue-600 hover:bg-gray-100',
                    'outline' => 'border-2 border-white text-white hover:bg-white hover:text-blue-600',
                    default => 'bg-gray-900 text-white hover:bg-gray-800',
                };
            @endphp
            <a href="{{ $section->button->url }}"
               class="inline-block font-semibold px-8 py-3 rounded-lg transition-colors {{ $buttonClasses }}">
                {{ $section->button->text }}
            </a>
        @endif
    </div>
</div>
