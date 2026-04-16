<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\ButtonViewModel;
use Brigada\StatamicCmsStarter\ViewModels\Sections\CtaViewModel;

class CtaSection implements SectionContract
{
    public function __construct(
        private readonly string $heading,
        private readonly ?string $description,
        private readonly ?string $buttonText,
        private readonly ?string $buttonUrl,
        private readonly string $buttonStyle,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'cta';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.cta';
    }

    public function toViewModel(): CtaViewModel
    {
        $button = ($this->buttonText && $this->buttonUrl)
            ? new ButtonViewModel(text: $this->buttonText, url: $this->buttonUrl, style: $this->buttonStyle)
            : null;

        return new CtaViewModel(
            heading: $this->heading,
            headingTag: $this->headingTagValue,
            description: $this->description,
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
