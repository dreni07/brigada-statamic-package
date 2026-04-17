<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\TeamViewModel;

class TeamSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $members
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly ?string $sectionDescription,
        private readonly array $members,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'team';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.team';
    }

    public function toViewModel(): TeamViewModel
    {
        return new TeamViewModel(
            sectionHeading: $this->sectionHeading,
            sectionDescription: $this->sectionDescription,
            headingTag: $this->headingTagValue,
            members: array_map(
                fn (BlockContract $member) => $member->toViewModel(),
                $this->members,
            ),
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return $this->members;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
