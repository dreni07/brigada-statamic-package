<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\GalleryImageViewModel;

readonly class GalleryViewModel
{
    /**
     * @param  GalleryImageViewModel[]  $images
     */
    public function __construct(
        public ?string $sectionHeading,
        public string $headingTag,
        public string $layout,
        public int $columns,
        public array $images,
    ) {}
}
