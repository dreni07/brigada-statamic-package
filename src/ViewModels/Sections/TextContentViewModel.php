<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

readonly class TextContentViewModel
{
    public function __construct(
        public string $htmlContent,
        public string $headingTag,
    ) {}
}
