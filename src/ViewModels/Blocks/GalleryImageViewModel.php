<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class GalleryImageViewModel
{
    public function __construct(
        public string $image,
        public ?string $altText,
        public ?string $caption,
    ) {}
}
