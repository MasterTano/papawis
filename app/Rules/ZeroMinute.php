<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ZeroMinute implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value, $parameters = [], $validator = null)
    {
        return true;
        /**
         * Todo
         * Fixed logic here
         */
        $zeroMinuteDate = Carbon::now()->setMinute(0);
        return Carbon::make($value)->isSameMinute($zeroMinuteDate);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field must be zero in minutes.';
    }
}
