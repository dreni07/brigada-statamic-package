<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\TestimonialViewModel;

class TestimonialBlock implements BlockContract
{
    public function __construct(
        private readonly string $quote,
        private readonly string $authorName,
        private readonly ?string $authorRole,
        private readonly ?string $authorAvatar,
        private readonly ?int $rating,
    ) {}

    public function type(): string
    {
        return 'testimonial';
    }

    public function toViewModel(): TestimonialViewModel
    {
        return new TestimonialViewModel(
            quote: $this->quote,
            authorName: $this->authorName,
            authorRole: $this->authorRole,
            authorAvatar: $this->authorAvatar,
            rating: $this->rating,
        );
    }
}
