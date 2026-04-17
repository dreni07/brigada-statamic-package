<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\Domain\Blocks\FaqItemBlock;
use Brigada\StatamicCmsStarter\ViewModels\Sections\FaqViewModel;

class FaqSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $items
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly ?string $sectionDescription,
        private readonly array $items,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'faq';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.faq';
    }

    public function toViewModel(): FaqViewModel
    {
        return new FaqViewModel(
            sectionHeading: $this->sectionHeading,
            sectionDescription: $this->sectionDescription,
            headingTag: $this->headingTagValue,
            items: array_map(fn (BlockContract $item) => $item->toViewModel(), $this->items),
            jsonLd: $this->buildJsonLd(),
        );
    }

    public function isFullWidth(): bool
    {
        return false;
    }

    public function blocks(): array
    {
        return $this->items;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }

    private function buildJsonLd(): ?string
    {
        $faqItems = array_values(array_filter(
            $this->items,
            fn (BlockContract $item) => $item instanceof FaqItemBlock,
        ));

        if ($faqItems === []) {
            return null;
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(
                fn (FaqItemBlock $item) => [
                    '@type' => 'Question',
                    'name' => $item->question(),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $item->answer(),
                    ],
                ],
                $faqItems,
            ),
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
