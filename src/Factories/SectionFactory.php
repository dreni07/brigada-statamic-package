<?php

namespace Brigada\StatamicCmsStarter\Factories;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\Domain\Sections\ContactFormSection;
use Brigada\StatamicCmsStarter\Domain\Sections\ContentCardsSection;
use Brigada\StatamicCmsStarter\Domain\Sections\CtaSection;
use Brigada\StatamicCmsStarter\Domain\Sections\HeroSection;
use Brigada\StatamicCmsStarter\Domain\Sections\TextContentSection;
use Brigada\StatamicCmsStarter\Services\AssetResolverService;
use Brigada\StatamicCmsStarter\Services\DataNormalizerService;

class SectionFactory
{
    public function __construct(
        private readonly BlockFactory $blockFactory,
        private readonly AssetResolverService $assetResolver,
        private readonly DataNormalizerService $normalizer,
    ) {}

    public function create(string $type, array $data, string $headingTag): SectionContract
    {
        return match ($type) {
            'hero' => $this->createHero($data, $headingTag),
            'text_content' => $this->createTextContent($data, $headingTag),
            'content_cards' => $this->createContentCards($data, $headingTag),
            'cta' => $this->createCta($data, $headingTag),
            'contact_form' => $this->createContactForm($data, $headingTag),
            default => throw new \InvalidArgumentException("Unknown section type: {$type}"),
        };
    }

    private function createHero(array $data, string $headingTag): HeroSection
    {
        return new HeroSection(
            heading: $this->normalizer->normalizeString($data['heading'] ?? null, 'Welcome'),
            subheading: $this->normalizer->normalizeString($data['subheading'] ?? null) ?: null,
            backgroundImage: $this->assetResolver->resolve($data['background_image'] ?? null),
            ctaButtonText: $this->normalizer->normalizeString($data['cta_button_text'] ?? null) ?: null,
            ctaButtonUrl: $this->normalizer->normalizeUrl($data['cta_button_url'] ?? null),
            headingTagValue: $headingTag,
        );
    }

    private function createTextContent(array $data, string $headingTag): TextContentSection
    {
        return new TextContentSection(
            content: $this->normalizer->normalizeString($data['content'] ?? null),
            headingTagValue: $headingTag,
        );
    }

    private function createContentCards(array $data, string $headingTag): ContentCardsSection
    {
        $cards = array_map(
            fn (array $cardData) => $this->blockFactory->card($cardData),
            $data['cards'] ?? [],
        );

        return new ContentCardsSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            cards: $cards,
            headingTagValue: $headingTag,
        );
    }

    private function createCta(array $data, string $headingTag): CtaSection
    {
        return new CtaSection(
            heading: $this->normalizer->normalizeString($data['heading'] ?? null, 'Get Started'),
            description: $this->normalizer->normalizeString($data['description'] ?? null) ?: null,
            buttonText: $this->normalizer->normalizeString($data['button_text'] ?? null) ?: null,
            buttonUrl: $this->normalizer->normalizeUrl($data['button_url'] ?? null),
            buttonStyle: $this->normalizer->normalizeString($data['button_style'] ?? null, 'primary'),
            headingTagValue: $headingTag,
        );
    }

    private function createContactForm(array $data, string $headingTag): ContactFormSection
    {
        return new ContactFormSection(
            formHeading: $this->normalizer->normalizeString($data['form_heading'] ?? null) ?: null,
            formHandle: $this->normalizer->normalizeString($data['form_handle'] ?? null, 'contact'),
            headingTagValue: $headingTag,
        );
    }
}
