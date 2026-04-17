<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class FeatureViewModel
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?string $iconText,
        public ?string $iconImage,
    ) {}
}
