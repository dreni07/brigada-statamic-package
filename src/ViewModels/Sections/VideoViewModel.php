<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

readonly class VideoViewModel
{
    public function __construct(
        public ?string $sectionHeading,
        public ?string $sectionDescription,
        public string $headingTag,
        public string $source,
        public ?string $embedUrl,
        public ?string $fileUrl,
        public ?string $poster,
        public bool $autoplay,
        public bool $loop,
        public bool $muted,
    ) {}
}
