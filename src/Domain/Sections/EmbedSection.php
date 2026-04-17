<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\EmbedViewModel;

class EmbedSection implements SectionContract
{
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly string $mode,
        private readonly ?string $iframeUrl,
        private readonly ?string $iframeTitle,
        private readonly int $iframeHeight,
        private readonly ?string $rawHtml,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'embed';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.embed';
    }

    public function toViewModel(): EmbedViewModel
    {
        return new EmbedViewModel(
            sectionHeading: $this->sectionHeading,
            headingTag: $this->headingTagValue,
            mode: $this->mode,
            iframeUrl: $this->iframeUrl,
            iframeTitle: $this->iframeTitle,
            iframeHeight: $this->iframeHeight,
            rawHtml: $this->rawHtml,
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
