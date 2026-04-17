<?php 

    namespace Brigada\StatamicCmsStarter\Services;

    use Brigada\StatamicCmsStarter\Domain\SitemapEntry;
    use Brigada\StatamicCmsStarter\ViewModels\SitemapViewModel;
    use Statamic\Entries\Entry as EntryContract;
    use Statamic\Facades\Entry;

    class SitemapService 
    {
        public function build(): SitemapViewModel 
        {
            $entries = Entry::all()
                ->filter(fn (EntryContract $entry) => $this->shouldInclude($entry))
                ->map(fn (EntryContract $entry) => $this->toSitemapEntry($entry))
                ->values()
                ->all(); 

            $viewModels = array_map(
                fn (SitemapEntry $entry) => $entry->toViewModel(),
                $entries,
            );

            return new SitemapViewModel(entries: $viewModels);
        
        }

        private function shouldInclude(EntryContract $entry): bool 
        {
            if (! $entry->published()) return false;

            if ($entry->url() === null) return false;

            if ((bool) $entry->get('no_index')) return false;

            return true;
        }

        private function toSitemapEntry(EntryContract $entry): SitemapEntry 
        {
            return new SitemapEntry(
                loc: url($entry->url()),
                lastmod: $entry->lastModified()->format('Y-m-d')
            );
        }
    }