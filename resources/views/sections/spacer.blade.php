@php
    $heightClass = match($section->size) {
        'sm' => 'h-8',
        'lg' => 'h-24',
        'xl' => 'h-32',
        default => 'h-16',
    };
@endphp

<div class="{{ $heightClass }} flex items-center" aria-hidden="true">
    @if($section->showDivider)
        <div class="w-full max-w-4xl mx-auto px-4">
            <hr class="border-t border-gray-200">
        </div>
    @endif
</div>
