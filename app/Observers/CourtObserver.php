<?php

namespace App\Observers;

use App\Models\Court;

class CourtObserver
{
    /**
     * Handle the court "created" event.
     *
     * @param  \App\Models\Court  $court
     * @return void
     */
    public function created(Court $court)
    {
        //
    }

    /**
     * Handle the court "updated" event.
     *
     * @param  \App\Models\Court  $court
     * @return void
     */
    public function updated(Court $court)
    {
        //
    }

    /**
     * Handle the court "deleted" event.
     *
     * @param  \App\Models\Court  $court
     * @return void
     */
    public function deleted(Court $court)
    {
        if ($court->address->exists()) {
            $court->address->delete();
        }
    }

    /**
     * Handle the court "restored" event.
     *
     * @param  \App\Models\Court  $court
     * @return void
     */
    public function restored(Court $court)
    {
        //
    }

    /**
     * Handle the court "force deleted" event.
     *
     * @param  \App\Models\Court  $court
     * @return void
     */
    public function forceDeleted(Court $court)
    {
        //
    }
}
