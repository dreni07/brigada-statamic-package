<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class StatViewModel
{
    public function __construct(
        public string $value,
        public string $label,
        public ?string $prefix,
        public ?string $suffix,
    ) {}
}
