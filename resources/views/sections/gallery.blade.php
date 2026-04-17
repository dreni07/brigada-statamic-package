@php
    $gridCols = match($section->columns) {
        2 => 'md:grid-cols-2',
        4 => 'md:grid-cols-3 lg:grid-cols-4',
        default => 'md:grid-cols-2 lg:grid-cols-3',
    };
    $masonryCols = match($section->columns) {
        2 => 'md:columns-2',
        4 => 'md:columns-3 lg:columns-4',
        default => 'md:columns-2 lg:columns-3',
    };
@endphp

<div class="py-16 px-4">
    <div class="max-w-6xl mx-auto">
        @if($section->sectionHeading)
            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-10 text-center">
                {{ $section->sectionHeading }}
            </{{ $section->headingTag }}>
        @endif

        @if(count($section->images) > 0)
            @if($section->layout === 'masonry')
                <div class="columns-1 {{ $masonryCols }} gap-4 space-y-4">
                    @foreach($section->images as $image)
                        <figure class="break-inside-avoid">
                            <img src="{{ $image->image }}"
                                 alt="{{ $image->altText ?? '' }}"
                                 class="w-full h-auto rounded-lg">
                            @if($image->caption)
                                <figcaption class="mt-2 text-sm text-gray-500 text-center">{{ $image->caption }}</figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 {{ $gridCols }} gap-4">
                    @foreach($section->images as $image)
                        <figure>
                            <img src="{{ $image->image }}"
                                 alt="{{ $image->altText ?? '' }}"
                                 class="w-full aspect-square object-cover rounded-lg">
                            @if($image->caption)
                                <figcaption class="mt-2 text-sm text-gray-500 text-center">{{ $image->caption }}</figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
