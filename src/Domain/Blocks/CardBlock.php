<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\CardViewModel;

class CardBlock implements BlockContract
{
    public function __construct(
        private readonly string $title,
        private readonly ?string $description,
        private readonly ?string $image,
        private readonly ?string $link,
    ) {}

    public function type(): string
    {
        return 'card';
    }

    public function toViewModel(): CardViewModel
    {
        return new CardViewModel(
            title: $this->title,
            description: $this->description,
            image: $this->image,
            link: $this->link,
        );
    }
}
