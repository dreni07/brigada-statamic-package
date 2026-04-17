<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\FeatureViewModel;

class FeatureBlock implements BlockContract
{
    public function __construct(
        private readonly string $title,
        private readonly ?string $description,
        private readonly ?string $iconText,
        private readonly ?string $iconImage,
    ) {}

    public function type(): string
    {
        return 'feature';
    }

    public function toViewModel(): FeatureViewModel
    {
        return new FeatureViewModel(
            title: $this->title,
            description: $this->description,
            iconText: $this->iconText,
            iconImage: $this->iconImage,
        );
    }
}
