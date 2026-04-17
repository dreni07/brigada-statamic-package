<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

readonly class EmbedViewModel
{
    public function __construct(
        public ?string $sectionHeading,
        public string $headingTag,
        public string $mode,
        public ?string $iframeUrl,
        public ?string $iframeTitle,
        public int $iframeHeight,
        public ?string $rawHtml,
    ) {}
}
