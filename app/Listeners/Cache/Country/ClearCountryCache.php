<?php
/**
 * Description of ClearCountryCache.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Listeners\Cache\Country;


use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;

class ClearCountryCache
{

    /** @var CachedCountryRepositoryInterface */
    private $cachedCountryRepository;

    /**
     * ClearCountryCache constructor.
     * @param CachedCountryRepositoryInterface $cachedCountryRepository
     */
    public function __construct(
        CachedCountryRepositoryInterface $cachedCountryRepository
    )
    {
        $this->cachedCountryRepository = $cachedCountryRepository;
    }

    /**
     *
     */
    public function handle()
    {
        $this->cachedCountryRepository->clearSearchCache();
    }

}