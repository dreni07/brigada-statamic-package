<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

readonly class ContactFormViewModel
{
    public function __construct(
        public ?string $formHeading,
        public string $headingTag,
        public string $formHandle,
    ) {}
}
