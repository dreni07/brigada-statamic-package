<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\ButtonViewModel;

class ButtonBlock implements BlockContract
{
    public function __construct(
        private readonly string $text,
        private readonly string $url,
        private readonly string $style = 'primary',
    ) {}

    public function type(): string
    {
        return 'button';
    }

    public function toViewModel(): ButtonViewModel
    {
        return new ButtonViewModel(
            text: $this->text,
            url: $this->url,
            style: $this->style,
        );
    }
}
