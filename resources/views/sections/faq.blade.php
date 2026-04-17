@if($section->jsonLd)
    <script type="application/ld+json">{!! $section->jsonLd !!}</script>
@endif

@if($section->sectionHeading)
    <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-4 text-center">
        {{ $section->sectionHeading }}
    </{{ $section->headingTag }}>
@endif

@if($section->sectionDescription)
    <p class="text-lg text-gray-600 mb-10 text-center">{{ $section->sectionDescription }}</p>
@endif

@if(count($section->items) > 0)
    <div class="space-y-3">
        @foreach($section->items as $item)
            <details class="group border border-gray-200 rounded-lg bg-white">
                <summary class="flex items-center justify-between cursor-pointer p-5 font-semibold text-gray-900 list-none">
                    <span>{{ $item->question }}</span>
                    <span class="ml-4 text-gray-400 transition-transform group-open:rotate-180" aria-hidden="true">&#9662;</span>
                </summary>
                <div class="px-5 pb-5 text-gray-700 leading-relaxed">
                    {{ $item->answer }}
                </div>
            </details>
        @endforeach
    </div>
@endif
