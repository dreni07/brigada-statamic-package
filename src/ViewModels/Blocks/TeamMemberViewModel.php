<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class TeamMemberViewModel
{
    public function __construct(
        public string $name,
        public ?string $role,
        public ?string $bio,
        public ?string $photo,
        public ?string $emailUrl,
        public ?string $linkedinUrl,
        public ?string $twitterUrl,
        public ?string $websiteUrl,
    ) {}
}
