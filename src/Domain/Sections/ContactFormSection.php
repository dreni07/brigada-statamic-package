<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\ContactFormViewModel;

class ContactFormSection implements SectionContract
{
    public function __construct(
        private readonly ?string $formHeading,
        private readonly string $formHandle,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'contact_form';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.contact-form';
    }

    public function toViewModel(): ContactFormViewModel
    {
        return new ContactFormViewModel(
            formHeading: $this->formHeading,
            headingTag: $this->headingTagValue,
            formHandle: $this->formHandle,
        );
    }

    public function isFullWidth(): bool
    {
        return false;
    }

    public function blocks(): array
    {
        return [];
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
