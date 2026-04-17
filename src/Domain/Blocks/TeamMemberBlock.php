<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\TeamMemberViewModel;

class TeamMemberBlock implements BlockContract
{
    public function __construct(
        private readonly string $name,
        private readonly ?string $role,
        private readonly ?string $bio,
        private readonly ?string $photo,
        private readonly ?string $emailUrl,
        private readonly ?string $linkedinUrl,
        private readonly ?string $twitterUrl,
        private readonly ?string $websiteUrl,
    ) {}

    public function type(): string
    {
        return 'team_member';
    }

    public function toViewModel(): TeamMemberViewModel
    {
        return new TeamMemberViewModel(
            name: $this->name,
            role: $this->role,
            bio: $this->bio,
            photo: $this->photo,
            emailUrl: $this->emailUrl,
            linkedinUrl: $this->linkedinUrl,
            twitterUrl: $this->twitterUrl,
            websiteUrl: $this->websiteUrl,
        );
    }
}
