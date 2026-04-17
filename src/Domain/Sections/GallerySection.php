<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\GalleryViewModel;

class GallerySection implements SectionContract
{
    /**
     * @param  BlockContract[]  $images
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly string $layout,
        private readonly int $columns,
        private readonly array $images,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'gallery';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.gallery';
    }

    public function toViewModel(): GalleryViewModel
    {
        return new GalleryViewModel(
            sectionHeading: $this->sectionHeading,
            headingTag: $this->headingTagValue,
            layout: $this->layout,
            columns: $this->columns,
            images: array_map(
                fn (BlockContract $image) => $image->toViewModel(),
                $this->images,
            ),
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return $this->images;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
