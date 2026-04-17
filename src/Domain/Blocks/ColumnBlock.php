<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\ColumnViewModel;

class ColumnBlock implements BlockContract
{
    public function __construct(
        private readonly ?string $heading,
        private readonly string $htmlContent,
        private readonly ?string $image,
        private readonly ?string $buttonText,
        private readonly ?string $buttonUrl,
        private readonly string $buttonStyle,
    ) {}

    public function type(): string
    {
        return 'column';
    }

    public function toViewModel(): ColumnViewModel
    {
        return new ColumnViewModel(
            heading: $this->heading,
            htmlContent: $this->htmlContent,
            image: $this->image,
            buttonText: $this->buttonText,
            buttonUrl: $this->buttonUrl,
            buttonStyle: $this->buttonStyle,
        );
    }
}
