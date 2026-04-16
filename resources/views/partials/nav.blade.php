<header class="bg-white border-b border-gray-200">
    <nav class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="text-xl font-bold text-gray-900">
            {{ $siteName ?? config('app.name', 'Brigada CMS') }}
        </a>

        <ul class="flex items-center gap-6">
            @foreach($navItems ?? [] as $item)
                <li>
                    <a href="{{ $item['url'] }}"
                       class="text-sm font-medium {{ ($currentSlug ?? '') === $item['slug'] ? 'text-blue-600' : 'text-gray-600 hover:text-gray-900' }} transition-colors">
                        {{ $item['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
