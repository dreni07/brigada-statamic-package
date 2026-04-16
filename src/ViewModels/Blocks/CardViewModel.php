<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class CardViewModel
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?string $image,
        public ?string $link,
    ) {}
}
