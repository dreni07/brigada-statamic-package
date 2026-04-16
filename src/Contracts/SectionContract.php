<?php

namespace Brigada\StatamicCmsStarter\Contracts;

interface SectionContract
{
    public function type(): string;

    public function viewName(): string;

    public function toViewModel(): object;

    public function isFullWidth(): bool;

    public function blocks(): array;

    public function headingTag(): string;
}
