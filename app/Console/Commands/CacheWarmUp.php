<?php

namespace App\Console\Commands;

use App\Services\Cache\Tag;
use App\Services\Cache\WarmUpCacheService;
use Illuminate\Console\Command;

class CacheWarmUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm-up
                            {--D|--delete-old-cache : Should the old cache be deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command starts cache warming up.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param WarmUpCacheService $warmUpCacheService
     * @return mixed
     */
    public function handle(WarmUpCacheService $warmUpCacheService)
    {
        $options = $this->options();

        if (isset($options['delete-old-cache'])
            && (bool)$options['delete-old-cache']
            && $this->confirm('Cache will be deleted. Do you wish to continue?')
        ) {
            $availableTagList = [Tag::PUBLIC, Tag::EVENTS, Tag::LANGUAGES];

            $tag = $this->anticipate(
                'Enter a tag name to clear the cache (otherwise, the all cache will be rebuilt)',
                $availableTagList
            );

            if (empty($tag) || !in_array($tag, $availableTagList)) {
                $this->info('All cache deleted' . PHP_EOL);

                $warmUpCacheService->clearAll();
            } else {
                $this->info('Cache deleted by tag "' . $tag . '"' . PHP_EOL);
                $warmUpCacheService->clearByTag($tag);
            }
        }

        $warmUpCacheService->warmAll();

        echo 'Cache successfully warmed up';
    }
}
