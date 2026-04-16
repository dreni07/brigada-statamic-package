<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\ButtonViewModel;

readonly class CtaViewModel
{
    public function __construct(
        public string $heading,
        public string $headingTag,
        public ?string $description,
        public ?ButtonViewModel $button,
    ) {}
}
