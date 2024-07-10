<?php
namespace SimpleCMS\Bank\Validation\Rule;

use Illuminate\Contracts\Validation\Rule;
use SimpleCMS\Bank\Validation\BankCode;

/**
 * 银行代码
 *
 * @author Dennis Lui <hackout@vip.qq.com>
 */
class BankCodeRule implements Rule
{

    public function validate($attribute, $value, $parameters)
    {
        return $this->passes($attribute, $value);
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
        return (new BankCode($value))->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'The bank code is incorrect.';
    }
}