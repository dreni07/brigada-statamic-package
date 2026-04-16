@if(isset($page) && $page->seo)
    <title>{{ $page->seo->title }} | {{ $siteName ?? config('app.name') }}</title>
    <meta name="description" content="{{ $page->seo->description }}">

    @if($page->seo->noIndex)
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if($page->seo->canonicalUrl)
        <link rel="canonical" href="{{ $page->seo->canonicalUrl }}">
    @endif

    <meta property="og:title" content="{{ $page->seo->title }}">
    <meta property="og:description" content="{{ $page->seo->description }}">
    <meta property="og:type" content="{{ $page->seo->ogType }}">

    @if($page->seo->ogImage)
        <meta property="og:image" content="{{ $page->seo->ogImage }}">
    @endif
@else
    <title>{{ $siteName ?? config('app.name') }}</title>
@endif
