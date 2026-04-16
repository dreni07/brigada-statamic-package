<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

readonly class HeroViewModel
{
    public function __construct(
        public string $heading,
        public string $headingTag,
        public ?string $subheading,
        public ?string $backgroundImage,
        public ?string $ctaButtonText,
        public ?string $ctaButtonUrl,
    ) {}
}
