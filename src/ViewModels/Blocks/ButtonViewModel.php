<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class ButtonViewModel
{
    public function __construct(
        public string $text,
        public string $url,
        public string $style,
    ) {}
}
