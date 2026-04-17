<?php

namespace Brigada\StatamicCmsStarter\Factories;

use Brigada\StatamicCmsStarter\Domain\Blocks\ButtonBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\CardBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\ColumnBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\FaqItemBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\FeatureBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\GalleryImageBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\PricingTierBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\StatBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\TeamMemberBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\TestimonialBlock;
use Brigada\StatamicCmsStarter\Services\AssetResolverService;
use Brigada\StatamicCmsStarter\Services\DataNormalizerService;

class BlockFactory
{
    public function __construct(
        private readonly AssetResolverService $assetResolver,
        private readonly DataNormalizerService $normalizer,
    ) {}

    public function card(array $data): CardBlock
    {
        return new CardBlock(
            title: $this->normalizer->normalizeString($data['card_title'] ?? null, 'Untitled'),
            description: $this->normalizer->normalizeString($data['card_description'] ?? null) ?: null,
            image: $this->assetResolver->resolve($data['card_image'] ?? null),
            link: $this->normalizer->normalizeUrl($data['card_link'] ?? null),
        );
    }

    public function button(array $data): ButtonBlock
    {
        return new ButtonBlock(
            text: $this->normalizer->normalizeString($data['button_text'] ?? $data['text'] ?? null, 'Click'),
            url: $this->normalizer->normalizeString($data['button_url'] ?? $data['url'] ?? null, '#'),
            style: $this->normalizer->normalizeString($data['button_style'] ?? $data['style'] ?? null, 'primary'),
        );
    }

    public function faqItem(array $data): FaqItemBlock
    {
        return new FaqItemBlock(
            question: $this->normalizer->normalizeString($data['question'] ?? null, 'Question'),
            answer: $this->normalizer->normalizeString($data['answer'] ?? null),
        );
    }

    public function testimonial(array $data): TestimonialBlock
    {
        $rating = $data['rating'] ?? null;
        $rating = is_numeric($rating) ? (int) $rating : null;

        if ($rating !== null) {
            $rating = max(0, min(5, $rating));
        }

        return new TestimonialBlock(
            quote: $this->normalizer->normalizeString($data['quote'] ?? null),
            authorName: $this->normalizer->normalizeString($data['author_name'] ?? null, 'Anonymous'),
            authorRole: $this->normalizer->normalizeString($data['author_role'] ?? null) ?: null,
            authorAvatar: $this->assetResolver->resolve($data['author_avatar'] ?? null),
            rating: $rating,
        );
    }

    public function feature(array $data): FeatureBlock
    {
        return new FeatureBlock(
            title: $this->normalizer->normalizeString($data['feature_title'] ?? null, 'Untitled'),
            description: $this->normalizer->normalizeString($data['feature_description'] ?? null) ?: null,
            iconText: $this->normalizer->normalizeString($data['icon_text'] ?? null) ?: null,
            iconImage: $this->assetResolver->resolve($data['icon_image'] ?? null),
        );
    }

    public function stat(array $data): StatBlock
    {
        return new StatBlock(
            value: $this->normalizer->normalizeString($data['value'] ?? null, '0'),
            label: $this->normalizer->normalizeString($data['label'] ?? null, 'Metric'),
            prefix: $this->normalizer->normalizeString($data['prefix'] ?? null) ?: null,
            suffix: $this->normalizer->normalizeString($data['suffix'] ?? null) ?: null,
        );
    }

    public function teamMember(array $data): TeamMemberBlock
    {
        return new TeamMemberBlock(
            name: $this->normalizer->normalizeString($data['name'] ?? null, 'Team Member'),
            role: $this->normalizer->normalizeString($data['role'] ?? null) ?: null,
            bio: $this->normalizer->normalizeString($data['bio'] ?? null) ?: null,
            photo: $this->assetResolver->resolve($data['photo'] ?? null),
            emailUrl: $this->normalizer->normalizeString($data['email'] ?? null) ?: null,
            linkedinUrl: $this->normalizer->normalizeUrl($data['linkedin_url'] ?? null),
            twitterUrl: $this->normalizer->normalizeUrl($data['twitter_url'] ?? null),
            websiteUrl: $this->normalizer->normalizeUrl($data['website_url'] ?? null),
        );
    }

    public function galleryImage(array $data): GalleryImageBlock
    {
        $imageUrl = $this->assetResolver->resolve($data['image'] ?? null);

        return new GalleryImageBlock(
            image: $imageUrl ?? '',
            altText: $this->normalizer->normalizeString($data['alt_text'] ?? null) ?: null,
            caption: $this->normalizer->normalizeString($data['caption'] ?? null) ?: null,
        );
    }

    public function pricingTier(array $data): PricingTierBlock
    {
        $rawFeatures = $data['features'] ?? [];
        $features = [];

        if (is_array($rawFeatures)) {
            foreach ($rawFeatures as $entry) {
                $text = is_array($entry)
                    ? ($entry['feature'] ?? $entry['text'] ?? null)
                    : $entry;
                $normalized = $this->normalizer->normalizeString($text);

                if ($normalized !== '') {
                    $features[] = $normalized;
                }
            }
        }

        return new PricingTierBlock(
            name: $this->normalizer->normalizeString($data['tier_name'] ?? null, 'Plan'),
            description: $this->normalizer->normalizeString($data['tier_description'] ?? null) ?: null,
            price: $this->normalizer->normalizeString($data['price'] ?? null, '0'),
            pricePrefix: $this->normalizer->normalizeString($data['price_prefix'] ?? null) ?: null,
            pricePeriod: $this->normalizer->normalizeString($data['price_period'] ?? null) ?: null,
            features: $features,
            buttonText: $this->normalizer->normalizeString($data['button_text'] ?? null) ?: null,
            buttonUrl: $this->normalizer->normalizeUrl($data['button_url'] ?? null),
            buttonStyle: $this->normalizer->normalizeString($data['button_style'] ?? null, 'primary'),
            isFeatured: $this->normalizer->normalizeBool($data['is_featured'] ?? null),
        );
    }

    public function column(array $data): ColumnBlock
    {
        $content = $data['content'] ?? '';

        if (is_array($content)) {
            $content = '';
        }

        return new ColumnBlock(
            heading: $this->normalizer->normalizeString($data['column_heading'] ?? null) ?: null,
            htmlContent: is_string($content) ? $content : '',
            image: $this->assetResolver->resolve($data['column_image'] ?? null),
            buttonText: $this->normalizer->normalizeString($data['button_text'] ?? null) ?: null,
            buttonUrl: $this->normalizer->normalizeUrl($data['button_url'] ?? null),
            buttonStyle: $this->normalizer->normalizeString($data['button_style'] ?? null, 'primary'),
        );
    }
}
