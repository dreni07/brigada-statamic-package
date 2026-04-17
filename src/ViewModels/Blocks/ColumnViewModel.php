<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class ColumnViewModel
{
    public function __construct(
        public ?string $heading,
        public string $htmlContent,
        public ?string $image,
        public ?string $buttonText,
        public ?string $buttonUrl,
        public string $buttonStyle,
    ) {}
}
