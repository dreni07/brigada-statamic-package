@extends('cms-starter::layout')

@section('content')
    @foreach($page->sections as $entry)
        @if($entry->isFullWidth)
            <section class="w-full">
                @include($entry->viewName, ['section' => $entry->data])
            </section>
        @else
            <section class="max-w-4xl mx-auto px-4 py-12">
                @include($entry->viewName, ['section' => $entry->data])
            </section>
        @endif
    @endforeach
@endsection
