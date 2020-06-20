<?php

namespace App\Observers;

use App\Models\Advert;



class AdvertObserver
{
    /**
     * Handle the advert "created" event.
     *
     * @param  \App\Advert  $advert
     * @return void
     */
    public function created(Advert $advert)
    {
        $this->forgetCache();
    }

    /**
     * Handle the advert "updated" event.
     *
     * @param  \App\Advert  $advert
     * @return void
     */
    public function updated(Advert $advert)
    {
        $this->forgetCache();
    }

    /**
     * Handle the advert "deleted" event.
     *
     * @param  \App\Advert  $advert
     * @return void
     */
    public function deleted(Advert $advert)
    {
        $this->forgetCache();
    }

    /**
     * Handle the advert "restored" event.
     *
     * @param  \App\Advert  $advert
     * @return void
     */
    public function restored(Advert $advert)
    {
        //
    }

    /**
     * Handle the advert "force deleted" event.
     *
     * @param  \App\Advert  $advert
     * @return void
     */
    public function forceDeleted(Advert $advert)
    {
        //
    }

    public function forgetCache()
    {
        \Cache::forget('homeList');
        \Cache::forget('advertList');
        \Cache::forget('messageList');
    }
}
