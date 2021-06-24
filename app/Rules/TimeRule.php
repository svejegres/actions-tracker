<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeRule implements Rule
{
    private $allowedOnlyOnceCharacters = [' ', 'm', 'h', 'd'];

    /**
     * Determine if the validation rule passes.
     *
     * Valid such values as "45m", "1h", "1h 15m", "1d", etc.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (gettype($value) !== 'string') {
            return false;
        }

        $time = trim($value);

        if (intval($time) === 0) {
            return false;
        }

        if (preg_match('/[^0-9 mhd]/', $time)) {
            return false;
        }

        foreach ($this->allowedOnlyOnceCharacters as $allowedOnlyOnceCharacter) {
            if (substr_count($time, $allowedOnlyOnceCharacter) > 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('Invalid :attribute format. Valid examples: "45m", "1h", "1h 15m", "1d".');
    }
}
