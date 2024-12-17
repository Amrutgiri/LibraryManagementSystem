<?php

namespace App;

use Illuminate\Support\Carbon;

trait commanTrait
{
    /**
     * Get the date after a certain number of days from today.
     *
     * @param  int  $days
     * @return string
     */
    public function getDateAfterDays($days)
    {
        return Carbon::now()->addDays($days)->toDateString();
    }
}
