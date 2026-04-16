<?php

namespace Brigada\StatamicCmsStarter\Contracts;

interface PageRepositoryContract
{
    public function findBySlug(string $slug): ?array;

    public function allPages(): array;
}
