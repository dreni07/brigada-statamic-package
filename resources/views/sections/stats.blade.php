<div class="bg-gray-900 text-white py-16 px-4">
    <div class="max-w-6xl mx-auto">
        @if($section->sectionHeading)
            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-4 text-center">
                {{ $section->sectionHeading }}
            </{{ $section->headingTag }}>
        @endif

        @if($section->sectionDescription)
            <p class="text-lg text-gray-300 mb-12 text-center max-w-3xl mx-auto">{{ $section->sectionDescription }}</p>
        @endif

        @if(count($section->stats) > 0)
            @php
                $count = count($section->stats);
                $gridClass = $count >= 4 ? 'md:grid-cols-4' : ($count === 3 ? 'md:grid-cols-3' : 'md:grid-cols-2');
            @endphp
            <dl class="grid grid-cols-1 {{ $gridClass }} gap-8 text-center">
                @foreach($section->stats as $stat)
                    <div>
                        <dt class="sr-only">{{ $stat->label }}</dt>
                        <dd class="text-4xl md:text-5xl font-bold text-white mb-2">
                            @if($stat->prefix)<span class="text-gray-400">{{ $stat->prefix }}</span>@endif
                            {{ $stat->value }}
                            @if($stat->suffix)<span class="text-gray-400">{{ $stat->suffix }}</span>@endif
                        </dd>
                        <dd class="text-sm md:text-base text-gray-400 uppercase tracking-wide">{{ $stat->label }}</dd>
                    </div>
                @endforeach
            </dl>
        @endif
    </div>
</div>
