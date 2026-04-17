<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

readonly class SpacerViewModel
{
    public function __construct(
        public string $size,
        public bool $showDivider,
    ) {}
}
