@php
    $gridClass = match($section->columns) {
        2 => 'md:grid-cols-2',
        4 => 'md:grid-cols-2 lg:grid-cols-4',
        default => 'md:grid-cols-2 lg:grid-cols-3',
    };
@endphp

<div class="py-16 px-4">
    <div class="max-w-6xl mx-auto">
        @if($section->sectionHeading)
            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-4 text-center">
                {{ $section->sectionHeading }}
            </{{ $section->headingTag }}>
        @endif

        @if($section->sectionDescription)
            <p class="text-lg text-gray-600 mb-12 text-center max-w-3xl mx-auto">{{ $section->sectionDescription }}</p>
        @endif

        @if(count($section->features) > 0)
            <div class="grid grid-cols-1 {{ $gridClass }} gap-8">
                @foreach($section->features as $feature)
                    <div class="flex flex-col items-start">
                        <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 mb-4">
                            @if($feature->iconImage)
                                <img src="{{ $feature->iconImage }}" alt="" class="w-7 h-7 object-contain">
                            @elseif($feature->iconText)
                                <span class="text-2xl" aria-hidden="true">{{ $feature->iconText }}</span>
                            @else
                                <span class="text-2xl" aria-hidden="true">&#9733;</span>
                            @endif
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $feature->title }}</h3>

                        @if($feature->description)
                            <p class="text-gray-600 leading-relaxed">{{ $feature->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
