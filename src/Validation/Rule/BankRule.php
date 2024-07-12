<?php
namespace SimpleCMS\Bank\Validation\Rule;

use Illuminate\Contracts\Validation\Rule;
use SimpleCMS\Bank\Validation\Bank;

/**
 * 银行名称
 *
 * @author Dennis Lui <hackout@vip.qq.com>
 */
class BankRule implements Rule
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
        return (new Bank($value))->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'The name of bank is incorrect.';
    }
}