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

        @if(count($section->tiers) > 0)
            @php
                $tierCount = count($section->tiers);
                $gridCols = $tierCount >= 4 ? 'lg:grid-cols-4' : ($tierCount === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2');
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 {{ $gridCols }} gap-6 items-stretch">
                @foreach($section->tiers as $tier)
                    @php
                        $cardClasses = $tier->isFeatured
                            ? 'relative bg-white border-2 border-blue-600 shadow-xl lg:scale-105'
                            : 'bg-white border border-gray-200 shadow-sm';
                        $buttonClasses = match($tier->buttonStyle) {
                            'secondary' => 'bg-gray-100 text-gray-900 hover:bg-gray-200',
                            'outline' => 'border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white',
                            default => 'bg-blue-600 text-white hover:bg-blue-700',
                        };
                    @endphp
                    <div class="rounded-lg p-8 flex flex-col {{ $cardClasses }}">
                        @if($tier->isFeatured)
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-xs font-semibold uppercase tracking-wide px-4 py-1 rounded-full">
                                Most Popular
                            </div>
                        @endif

                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $tier->name }}</h3>

                        @if($tier->description)
                            <p class="text-sm text-gray-600 mb-6">{{ $tier->description }}</p>
                        @endif

                        <div class="mb-6 flex items-baseline">
                            @if($tier->pricePrefix)
                                <span class="text-xl font-semibold text-gray-500 mr-1">{{ $tier->pricePrefix }}</span>
                            @endif
                            <span class="text-4xl md:text-5xl font-bold text-gray-900">{{ $tier->price }}</span>
                            @if($tier->pricePeriod)
                                <span class="text-base text-gray-500 ml-2">{{ $tier->pricePeriod }}</span>
                            @endif
                        </div>

                        @if(count($tier->features) > 0)
                            <ul class="space-y-3 mb-8 flex-1">
                                @foreach($tier->features as $feature)
                                    <li class="flex items-start text-gray-700">
                                        <span class="text-green-500 mr-2 flex-shrink-0" aria-hidden="true">&#10003;</span>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if($tier->buttonText && $tier->buttonUrl)
                            <a href="{{ $tier->buttonUrl }}"
                               class="block text-center font-semibold px-6 py-3 rounded-lg transition-colors {{ $buttonClasses }}">
                                {{ $tier->buttonText }}
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
