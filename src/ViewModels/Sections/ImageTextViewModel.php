<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\ButtonViewModel;

readonly class ImageTextViewModel
{
    public function __construct(
        public string $heading,
        public string $headingTag,
        public ?string $subheading,
        public string $htmlContent,
        public ?string $image,
        public ?string $imageAlt,
        public string $imagePosition,
        public ?ButtonViewModel $button,
    ) {}
}
