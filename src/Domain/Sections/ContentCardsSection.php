<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\ContentCardsViewModel;

class ContentCardsSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $cards
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly array $cards,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'content_cards';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.content-cards';
    }

    public function toViewModel(): ContentCardsViewModel
    {
        return new ContentCardsViewModel(
            sectionHeading: $this->sectionHeading,
            headingTag: $this->headingTagValue,
            cards: array_map(fn (BlockContract $card) => $card->toViewModel(), $this->cards),
        );
    }

    public function isFullWidth(): bool
    {
        return false;
    }

    public function blocks(): array
    {
        return $this->cards;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
