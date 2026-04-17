<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\TestimonialViewModel;

readonly class TestimonialsViewModel
{
    /**
     * @param  TestimonialViewModel[]  $testimonials
     */
    public function __construct(
        public ?string $sectionHeading,
        public ?string $sectionDescription,
        public string $headingTag,
        public array $testimonials,
    ) {}
}
