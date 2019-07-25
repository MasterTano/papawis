<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator as Validator;
use Carbon\Carbon;

class HoursDiffWith implements Rule
{

    private $diffWithKey;
    private $diffShouldBe;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $diffWithKey, int $diffShouldBe)
    {
        $this->diffWithKey = $diffWithKey;
        $this->diffShouldBe = $diffShouldBe;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $diffWith = request($this->diffWithKey);

        if (!$diffWith || !$this->diffShouldBe || !$this->diffWithKey) {
            return false;
        }

        return Carbon::make($value)->diffInHours(Carbon::make($diffWith)) >= (int)$this->diffShouldBe;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute field must have {$this->diffShouldBe} hours difference with {$this->diffWithKey} field.";
    }
}
