<?php
/**
 * Description of ClearCountryCache.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Listeners\Cache\Country;


use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;
use App\Services\Events\Models\Country\CountrySaved;

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
     * @param CountrySaved $countrySaved
     */
    public function handle(CountrySaved $countrySaved)
    {
        $this->cachedCountryRepository->clearCountryCache(
            $countrySaved->getCountry()
        );
    }

}
