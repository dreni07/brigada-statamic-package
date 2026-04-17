<?php

namespace Brigada\StatamicCmsStarter\Http\ViewComposers;

use Brigada\StatamicCmsStarter\Services\SchemaService;
use Illuminate\View\View;

class SchemaComposer
{
    public function __construct(
        private readonly SchemaService $schema,
    ) {}

    public function compose(View $view): void
    {
        $view->with('schema', $this->schema->buildForCurrentRequest());
    }
}
