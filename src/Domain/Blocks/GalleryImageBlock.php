<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\GalleryImageViewModel;

class GalleryImageBlock implements BlockContract
{
    public function __construct(
        private readonly string $image,
        private readonly ?string $altText,
        private readonly ?string $caption,
    ) {}

    public function type(): string
    {
        return 'gallery_image';
    }

    public function toViewModel(): GalleryImageViewModel
    {
        return new GalleryImageViewModel(
            image: $this->image,
            altText: $this->altText,
            caption: $this->caption,
        );
    }
}
