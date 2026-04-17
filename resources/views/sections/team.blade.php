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

        @if(count($section->members) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($section->members as $member)
                    <div class="text-center">
                        @if($member->photo)
                            <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-32 h-32 rounded-full object-cover mx-auto mb-4">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gray-200 mx-auto mb-4 flex items-center justify-center text-gray-400 text-3xl font-semibold">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </div>
                        @endif

                        <h3 class="text-lg font-semibold text-gray-900">{{ $member->name }}</h3>

                        @if($member->role)
                            <p class="text-sm text-blue-600 mb-3">{{ $member->role }}</p>
                        @endif

                        @if($member->bio)
                            <p class="text-sm text-gray-600 leading-relaxed mb-4">{{ $member->bio }}</p>
                        @endif

                        @if($member->emailUrl || $member->linkedinUrl || $member->twitterUrl || $member->websiteUrl)
                            <div class="flex justify-center gap-3 text-gray-400">
                                @if($member->emailUrl)
                                    <a href="mailto:{{ $member->emailUrl }}" class="hover:text-gray-700" aria-label="Email {{ $member->name }}">&#9993;</a>
                                @endif
                                @if($member->linkedinUrl)
                                    <a href="{{ $member->linkedinUrl }}" class="hover:text-gray-700" target="_blank" rel="noopener" aria-label="{{ $member->name }} on LinkedIn">in</a>
                                @endif
                                @if($member->twitterUrl)
                                    <a href="{{ $member->twitterUrl }}" class="hover:text-gray-700" target="_blank" rel="noopener" aria-label="{{ $member->name }} on Twitter">&#x1D54F;</a>
                                @endif
                                @if($member->websiteUrl)
                                    <a href="{{ $member->websiteUrl }}" class="hover:text-gray-700" target="_blank" rel="noopener" aria-label="{{ $member->name }}'s website">&#9901;</a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
