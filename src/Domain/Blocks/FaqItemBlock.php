<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\FaqItemViewModel;

class FaqItemBlock implements BlockContract
{
    public function __construct(
        private readonly string $question,
        private readonly string $answer,
    ) {}

    public function type(): string
    {
        return 'faq_item';
    }

    public function question(): string
    {
        return $this->question;
    }

    public function answer(): string
    {
        return $this->answer;
    }

    public function toViewModel(): FaqItemViewModel
    {
        return new FaqItemViewModel(
            question: $this->question,
            answer: $this->answer,
        );
    }
}
