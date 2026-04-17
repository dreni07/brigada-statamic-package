<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class FaqItemViewModel
{
    public function __construct(
        public string $question,
        public string $answer,
    ) {}
}
