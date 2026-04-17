@foreach($robots->agents as $agent)
User-agent: {{ $agent->userAgent }}
@foreach($agent->disallow as $path)
Disallow: {{ $path }}
@endforeach
@foreach($agent->allow as $path)
Allow: {{ $path }}
@endforeach
@if(count($agent->disallow) === 0 && count($agent->allow) === 0)
Disallow:
@endif

@endforeach
@if($robots->sitemapUrl)
Sitemap: {{ $robots->sitemapUrl }}
@endif
