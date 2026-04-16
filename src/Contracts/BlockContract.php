<?php

namespace Brigada\StatamicCmsStarter\Contracts;

interface BlockContract
{
    public function type(): string;

    public function toViewModel(): object;
}
