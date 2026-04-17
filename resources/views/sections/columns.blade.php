@php
    $gridCols = match($section->columnCount) {
        2 => 'md:grid-cols-2',
        4 => 'md:grid-cols-2 lg:grid-cols-4',
        default => 'md:grid-cols-2 lg:grid-cols-3',
    };
    $alignClass = match($section->verticalAlign) {
        'center' => 'items-center',
        'bottom' => 'items-end',
        default => 'items-start',
    };
@endphp

<div class="py-16 px-4">
    <div class="max-w-6xl mx-auto">
        @if($section->sectionHeading)
            <{{ $section->headingTag }} class="text-3xl md:text-4xl font-bold mb-10 text-center">
                {{ $section->sectionHeading }}
            </{{ $section->headingTag }}>
        @endif

        @if(count($section->columns) > 0)
            <div class="grid grid-cols-1 {{ $gridCols }} gap-10 {{ $alignClass }}">
                @foreach($section->columns as $column)
                    <div>
                        @if($column->image)
                            <img src="{{ $column->image }}" alt="{{ $column->heading ?? '' }}" class="w-full h-auto rounded-lg mb-4 object-cover">
                        @endif

                        @if($column->heading)
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $column->heading }}</h3>
                        @endif

                        @if($column->htmlContent)
                            <div class="prose text-gray-700 max-w-none">
                                {!! $column->htmlContent !!}
                            </div>
                        @endif

                        @if($column->buttonText && $column->buttonUrl)
                            @php
                                $buttonClasses = match($column->buttonStyle) {
                                    'secondary' => 'bg-gray-100 text-gray-900 hover:bg-gray-200',
                                    'outline' => 'border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white',
                                    default => 'bg-blue-600 text-white hover:bg-blue-700',
                                };
                            @endphp
                            <a href="{{ $column->buttonUrl }}"
                               class="inline-block mt-4 font-semibold px-6 py-2.5 rounded-lg transition-colors {{ $buttonClasses }}">
                                {{ $column->buttonText }}
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
