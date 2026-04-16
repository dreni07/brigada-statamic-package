<?php

namespace Brigada\StatamicCmsStarter\ViewModels;

readonly class SeoViewModel
{
    public function __construct(
        public string $title,
        public string $description,
        public ?string $canonicalUrl,
        public bool $noIndex,
        public ?string $ogImage,
        public string $ogType,
    ) {}
}
