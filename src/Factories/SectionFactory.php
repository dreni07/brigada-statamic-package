<?php

namespace Brigada\StatamicCmsStarter\Factories;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\Domain\Sections\ColumnsSection;
use Brigada\StatamicCmsStarter\Domain\Sections\ContactFormSection;
use Brigada\StatamicCmsStarter\Domain\Sections\ContentCardsSection;
use Brigada\StatamicCmsStarter\Domain\Sections\CtaSection;
use Brigada\StatamicCmsStarter\Domain\Sections\EmbedSection;
use Brigada\StatamicCmsStarter\Domain\Sections\FaqSection;
use Brigada\StatamicCmsStarter\Domain\Sections\FeaturesSection;
use Brigada\StatamicCmsStarter\Domain\Sections\GallerySection;
use Brigada\StatamicCmsStarter\Domain\Sections\HeroSection;
use Brigada\StatamicCmsStarter\Domain\Sections\ImageTextSection;
use Brigada\StatamicCmsStarter\Domain\Sections\PricingSection;
use Brigada\StatamicCmsStarter\Domain\Sections\RichTextSection;
use Brigada\StatamicCmsStarter\Domain\Sections\SpacerSection;
use Brigada\StatamicCmsStarter\Domain\Sections\StatsSection;
use Brigada\StatamicCmsStarter\Domain\Sections\TeamSection;
use Brigada\StatamicCmsStarter\Domain\Sections\TestimonialsSection;
use Brigada\StatamicCmsStarter\Domain\Sections\TextContentSection;
use Brigada\StatamicCmsStarter\Domain\Sections\VideoSection;
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
            'faq' => $this->createFaq($data, $headingTag),
            'testimonials' => $this->createTestimonials($data, $headingTag),
            'features' => $this->createFeatures($data, $headingTag),
            'stats' => $this->createStats($data, $headingTag),
            'team' => $this->createTeam($data, $headingTag),
            'image_text' => $this->createImageText($data, $headingTag),
            'gallery' => $this->createGallery($data, $headingTag),
            'video' => $this->createVideo($data, $headingTag),
            'pricing' => $this->createPricing($data, $headingTag),
            'spacer' => $this->createSpacer($data, $headingTag),
            'columns' => $this->createColumns($data, $headingTag),
            'rich_text' => $this->createRichText($data, $headingTag),
            'embed' => $this->createEmbed($data, $headingTag),
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

    private function createFaq(array $data, string $headingTag): FaqSection
    {
        $items = array_map(
            fn (array $itemData) => $this->blockFactory->faqItem($itemData),
            $data['items'] ?? [],
        );

        return new FaqSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            sectionDescription: $this->normalizer->normalizeString($data['section_description'] ?? null) ?: null,
            items: $items,
            headingTagValue: $headingTag,
        );
    }

    private function createTestimonials(array $data, string $headingTag): TestimonialsSection
    {
        $testimonials = array_map(
            fn (array $itemData) => $this->blockFactory->testimonial($itemData),
            $data['testimonials'] ?? [],
        );

        return new TestimonialsSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            sectionDescription: $this->normalizer->normalizeString($data['section_description'] ?? null) ?: null,
            testimonials: $testimonials,
            headingTagValue: $headingTag,
        );
    }

    private function createFeatures(array $data, string $headingTag): FeaturesSection
    {
        $features = array_map(
            fn (array $itemData) => $this->blockFactory->feature($itemData),
            $data['features'] ?? [],
        );

        $columns = (int) ($data['columns'] ?? 3);
        $columns = in_array($columns, [2, 3, 4], true) ? $columns : 3;

        return new FeaturesSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            sectionDescription: $this->normalizer->normalizeString($data['section_description'] ?? null) ?: null,
            columns: $columns,
            features: $features,
            headingTagValue: $headingTag,
        );
    }

    private function createStats(array $data, string $headingTag): StatsSection
    {
        $stats = array_map(
            fn (array $itemData) => $this->blockFactory->stat($itemData),
            $data['stats'] ?? [],
        );

        return new StatsSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            sectionDescription: $this->normalizer->normalizeString($data['section_description'] ?? null) ?: null,
            stats: $stats,
            headingTagValue: $headingTag,
        );
    }

    private function createTeam(array $data, string $headingTag): TeamSection
    {
        $members = array_map(
            fn (array $itemData) => $this->blockFactory->teamMember($itemData),
            $data['members'] ?? [],
        );

        return new TeamSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            sectionDescription: $this->normalizer->normalizeString($data['section_description'] ?? null) ?: null,
            members: $members,
            headingTagValue: $headingTag,
        );
    }

    private function createImageText(array $data, string $headingTag): ImageTextSection
    {
        $position = $this->normalizer->normalizeString($data['image_position'] ?? null, 'right');
        $position = in_array($position, ['left', 'right'], true) ? $position : 'right';

        $content = $data['content'] ?? '';
        $htmlContent = is_string($content) ? $content : '';

        return new ImageTextSection(
            heading: $this->normalizer->normalizeString($data['heading'] ?? null, 'Heading'),
            subheading: $this->normalizer->normalizeString($data['subheading'] ?? null) ?: null,
            htmlContent: $htmlContent,
            image: $this->assetResolver->resolve($data['image'] ?? null),
            imageAlt: $this->normalizer->normalizeString($data['image_alt'] ?? null) ?: null,
            imagePosition: $position,
            buttonText: $this->normalizer->normalizeString($data['button_text'] ?? null) ?: null,
            buttonUrl: $this->normalizer->normalizeUrl($data['button_url'] ?? null),
            buttonStyle: $this->normalizer->normalizeString($data['button_style'] ?? null, 'primary'),
            headingTagValue: $headingTag,
        );
    }

    private function createGallery(array $data, string $headingTag): GallerySection
    {
        $images = array_map(
            fn (array $itemData) => $this->blockFactory->galleryImage($itemData),
            $data['images'] ?? [],
        );

        $layout = $this->normalizer->normalizeString($data['layout'] ?? null, 'grid');
        $layout = in_array($layout, ['grid', 'masonry'], true) ? $layout : 'grid';

        $columns = (int) ($data['columns'] ?? 3);
        $columns = in_array($columns, [2, 3, 4], true) ? $columns : 3;

        return new GallerySection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            layout: $layout,
            columns: $columns,
            images: $images,
            headingTagValue: $headingTag,
        );
    }

    private function createVideo(array $data, string $headingTag): VideoSection
    {
        $source = $this->normalizer->normalizeString($data['source'] ?? null, 'youtube');
        $source = in_array($source, ['youtube', 'vimeo', 'file'], true) ? $source : 'youtube';

        $embedUrl = null;
        $fileUrl = null;

        if ($source === 'file') {
            $fileUrl = $this->assetResolver->resolve($data['video_file'] ?? null);
        } else {
            $url = $this->normalizer->normalizeUrl($data['video_url'] ?? null);
            $embedUrl = $url !== null ? $this->resolveVideoEmbedUrl($source, $url) : null;
        }

        return new VideoSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            sectionDescription: $this->normalizer->normalizeString($data['section_description'] ?? null) ?: null,
            source: $source,
            embedUrl: $embedUrl,
            fileUrl: $fileUrl,
            poster: $this->assetResolver->resolve($data['poster'] ?? null),
            autoplay: $this->normalizer->normalizeBool($data['autoplay'] ?? null),
            loop: $this->normalizer->normalizeBool($data['loop'] ?? null),
            muted: $this->normalizer->normalizeBool($data['muted'] ?? null),
            headingTagValue: $headingTag,
        );
    }

    private function resolveVideoEmbedUrl(string $source, string $url): ?string
    {
        if ($source === 'youtube') {
            if (preg_match('#(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{6,})#', $url, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }

            return null;
        }

        if ($source === 'vimeo') {
            if (preg_match('#vimeo\.com/(?:video/)?(\d+)#', $url, $matches)) {
                return 'https://player.vimeo.com/video/' . $matches[1];
            }

            return null;
        }

        return null;
    }

    private function createPricing(array $data, string $headingTag): PricingSection
    {
        $tiers = array_map(
            fn (array $itemData) => $this->blockFactory->pricingTier($itemData),
            $data['tiers'] ?? [],
        );

        return new PricingSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            sectionDescription: $this->normalizer->normalizeString($data['section_description'] ?? null) ?: null,
            tiers: $tiers,
            headingTagValue: $headingTag,
        );
    }

    private function createSpacer(array $data, string $headingTag): SpacerSection
    {
        $size = $this->normalizer->normalizeString($data['size'] ?? null, 'md');
        $size = in_array($size, ['sm', 'md', 'lg', 'xl'], true) ? $size : 'md';

        return new SpacerSection(
            size: $size,
            showDivider: $this->normalizer->normalizeBool($data['show_divider'] ?? null),
            headingTagValue: $headingTag,
        );
    }

    private function createColumns(array $data, string $headingTag): ColumnsSection
    {
        $columns = array_map(
            fn (array $itemData) => $this->blockFactory->column($itemData),
            $data['columns'] ?? [],
        );

        $count = (int) ($data['column_count'] ?? count($columns) ?: 2);
        $count = in_array($count, [2, 3, 4], true) ? $count : 2;

        $align = $this->normalizer->normalizeString($data['vertical_align'] ?? null, 'top');
        $align = in_array($align, ['top', 'center', 'bottom'], true) ? $align : 'top';

        return new ColumnsSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            columnCount: $count,
            verticalAlign: $align,
            columns: $columns,
            headingTagValue: $headingTag,
        );
    }

    private function createRichText(array $data, string $headingTag): RichTextSection
    {
        $format = $this->normalizer->normalizeString($data['format'] ?? null, 'bard');
        $format = in_array($format, ['bard', 'raw_html'], true) ? $format : 'bard';

        $maxWidth = $this->normalizer->normalizeString($data['max_width'] ?? null, 'normal');
        $maxWidth = in_array($maxWidth, ['narrow', 'normal', 'wide'], true) ? $maxWidth : 'normal';

        $content = $format === 'raw_html'
            ? ($data['raw_html'] ?? '')
            : ($data['content'] ?? '');

        $htmlContent = is_string($content) ? $content : '';

        return new RichTextSection(
            format: $format,
            htmlContent: $htmlContent,
            maxWidth: $maxWidth,
            headingTagValue: $headingTag,
        );
    }

    private function createEmbed(array $data, string $headingTag): EmbedSection
    {
        $mode = $this->normalizer->normalizeString($data['mode'] ?? null, 'iframe');
        $mode = in_array($mode, ['iframe', 'html'], true) ? $mode : 'iframe';

        $height = (int) ($data['iframe_height'] ?? 500);
        $height = max(100, min(2000, $height));

        $rawHtml = $data['raw_html'] ?? null;
        $rawHtml = is_string($rawHtml) ? $rawHtml : null;

        return new EmbedSection(
            sectionHeading: $this->normalizer->normalizeString($data['section_heading'] ?? null) ?: null,
            mode: $mode,
            iframeUrl: $this->normalizer->normalizeUrl($data['iframe_url'] ?? null),
            iframeTitle: $this->normalizer->normalizeString($data['iframe_title'] ?? null) ?: null,
            iframeHeight: $height,
            rawHtml: $rawHtml,
            headingTagValue: $headingTag,
        );
    }
}
