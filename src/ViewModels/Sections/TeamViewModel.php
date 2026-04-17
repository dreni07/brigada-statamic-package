<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\TeamMemberViewModel;

readonly class TeamViewModel
{
    /**
     * @param  TeamMemberViewModel[]  $members
     */
    public function __construct(
        public ?string $sectionHeading,
        public ?string $sectionDescription,
        public string $headingTag,
        public array $members,
    ) {}
}
