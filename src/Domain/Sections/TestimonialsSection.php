<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\TestimonialsViewModel;

class TestimonialsSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $testimonials
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly ?string $sectionDescription,
        private readonly array $testimonials,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'testimonials';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.testimonials';
    }

    public function toViewModel(): TestimonialsViewModel
    {
        return new TestimonialsViewModel(
            sectionHeading: $this->sectionHeading,
            sectionDescription: $this->sectionDescription,
            headingTag: $this->headingTagValue,
            testimonials: array_map(
                fn (BlockContract $testimonial) => $testimonial->toViewModel(),
                $this->testimonials,
            ),
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return $this->testimonials;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
