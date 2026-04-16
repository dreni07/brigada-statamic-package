<?php

namespace Brigada\StatamicCmsStarter\Factories;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Domain\Blocks\CardBlock;
use Brigada\StatamicCmsStarter\Domain\Blocks\ButtonBlock;
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
}
