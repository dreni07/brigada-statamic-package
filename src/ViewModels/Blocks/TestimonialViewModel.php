<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class TestimonialViewModel
{
    public function __construct(
        public string $quote,
        public string $authorName,
        public ?string $authorRole,
        public ?string $authorAvatar,
        public ?int $rating,
    ) {}
}
