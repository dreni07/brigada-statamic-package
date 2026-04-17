<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\ColumnViewModel;

readonly class ColumnsViewModel
{
    /**
     * @param  ColumnViewModel[]  $columns
     */
    public function __construct(
        public ?string $sectionHeading,
        public string $headingTag,
        public int $columnCount,
        public string $verticalAlign,
        public array $columns,
    ) {}
}
