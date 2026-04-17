<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\StatViewModel;

class StatBlock implements BlockContract
{
    public function __construct(
        private readonly string $value,
        private readonly string $label,
        private readonly ?string $prefix,
        private readonly ?string $suffix,
    ) {}

    public function type(): string
    {
        return 'stat';
    }

    public function toViewModel(): StatViewModel
    {
        return new StatViewModel(
            value: $this->value,
            label: $this->label,
            prefix: $this->prefix,
            suffix: $this->suffix,
        );
    }
}
