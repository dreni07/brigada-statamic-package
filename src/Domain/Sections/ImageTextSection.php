<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\ButtonViewModel;
use Brigada\StatamicCmsStarter\ViewModels\Sections\ImageTextViewModel;

class ImageTextSection implements SectionContract
{
    public function __construct(
        private readonly string $heading,
        private readonly ?string $subheading,
        private readonly string $htmlContent,
        private readonly ?string $image,
        private readonly ?string $imageAlt,
        private readonly string $imagePosition,
        private readonly ?string $buttonText,
        private readonly ?string $buttonUrl,
        private readonly string $buttonStyle,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'image_text';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.image-text';
    }

    public function toViewModel(): ImageTextViewModel
    {
        $button = ($this->buttonText && $this->buttonUrl)
            ? new ButtonViewModel(text: $this->buttonText, url: $this->buttonUrl, style: $this->buttonStyle)
            : null;

        return new ImageTextViewModel(
            heading: $this->heading,
            headingTag: $this->headingTagValue,
            subheading: $this->subheading,
            htmlContent: $this->htmlContent,
            image: $this->image,
            imageAlt: $this->imageAlt,
            imagePosition: $this->imagePosition,
            button: $button,
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return [];
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
