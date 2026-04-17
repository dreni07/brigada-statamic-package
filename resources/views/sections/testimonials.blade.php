<div class="bg-gray-50 py-16 px-4">
    <div class="max-w-6xl mx-auto">
        @if($section->sectionHeading)
            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-4 text-center">
                {{ $section->sectionHeading }}
            </{{ $section->headingTag }}>
        @endif

        @if($section->sectionDescription)
            <p class="text-lg text-gray-600 mb-12 text-center">{{ $section->sectionDescription }}</p>
        @endif

        @if(count($section->testimonials) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($section->testimonials as $testimonial)
                    <figure class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex flex-col">
                        @if($testimonial->rating !== null && $testimonial->rating > 0)
                            <div class="flex gap-0.5 mb-4" aria-label="{{ $testimonial->rating }} out of 5 stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-lg {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" aria-hidden="true">&#9733;</span>
                                @endfor
                            </div>
                        @endif

                        <blockquote class="text-gray-700 leading-relaxed flex-1">
                            &ldquo;{{ $testimonial->quote }}&rdquo;
                        </blockquote>

                        <figcaption class="mt-5 flex items-center gap-3">
                            @if($testimonial->authorAvatar)
                                <img src="{{ $testimonial->authorAvatar }}" alt="{{ $testimonial->authorName }}" class="w-12 h-12 rounded-full object-cover">
                            @endif

                            <div>
                                <div class="font-semibold text-gray-900">{{ $testimonial->authorName }}</div>
                                @if($testimonial->authorRole)
                                    <div class="text-sm text-gray-500">{{ $testimonial->authorRole }}</div>
                                @endif
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        @endif
    </div>
</div>
