<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\ColumnsViewModel;

class ColumnsSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $columns
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly int $columnCount,
        private readonly string $verticalAlign,
        private readonly array $columns,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'columns';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.columns';
    }

    public function toViewModel(): ColumnsViewModel
    {
        return new ColumnsViewModel(
            sectionHeading: $this->sectionHeading,
            headingTag: $this->headingTagValue,
            columnCount: $this->columnCount,
            verticalAlign: $this->verticalAlign,
            columns: array_map(
                fn (BlockContract $column) => $column->toViewModel(),
                $this->columns,
            ),
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return $this->columns;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
