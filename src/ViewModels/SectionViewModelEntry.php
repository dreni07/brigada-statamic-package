<?php

namespace Brigada\StatamicCmsStarter\ViewModels;

readonly class SectionViewModelEntry
{
    public function __construct(
        public string $viewName,
        public object $data,
        public bool $isFullWidth,
    ) {}
}
