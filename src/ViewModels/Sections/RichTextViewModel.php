<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

readonly class RichTextViewModel
{
    public function __construct(
        public string $format,
        public string $htmlContent,
        public string $maxWidth,
    ) {}
}
