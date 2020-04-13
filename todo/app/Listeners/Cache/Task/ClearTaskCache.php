<?php
/**
 * Description of ClearTaskCache.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Listeners\Cache\Task;


use App\Services\Tasks\Repositories\CachedTaskRepositoryInterface;

class ClearTaskCache
{

    /** @var CachedTaskRepositoryInterface */
    private $cachedTaskRepository;

    /**
     * ClearTaskCache constructor.
     * @param CachedTaskRepositoryInterface $cachedTaskRepository
     */
    public function __construct(
        CachedTaskRepositoryInterface $cachedTaskRepository
    )
    {
        $this->cachedTaskRepository = $cachedTaskRepository;
    }

    /**
     *
     */
    public function handle()
    {
        $this->cachedTaskRepository->clearSearchCache();
    }

}