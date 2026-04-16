@if($section->sectionHeading)
    <{{ $section->headingTag }} class="text-3xl font-bold mb-8 text-center">
        {{ $section->sectionHeading }}
    </{{ $section->headingTag }}>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($section->cards as $card)
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            @if($card->image)
                <img src="{{ $card->image }}" alt="{{ $card->title }}" class="w-full h-48 object-cover">
            @endif

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $card->title }}</h3>

                @if($card->description)
                    <p class="text-gray-600">{{ $card->description }}</p>
                @endif

                @if($card->link)
                    <a href="{{ $card->link }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium">
                        Learn more &rarr;
                    </a>
                @endif
            </div>
        </div>
    @endforeach
</div>
