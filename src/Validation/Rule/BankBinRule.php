<?php
namespace SimpleCMS\Bank\Validation\Rule;

use Illuminate\Contracts\Validation\Rule;
use SimpleCMS\Bank\Validation\BankBin;

/**
 * 银行bin
 *
 * @author Dennis Lui <hackout@vip.qq.com>
 */
class BankBinRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (new BankBin($value))->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'The bin code is incorrect.';
    }
}