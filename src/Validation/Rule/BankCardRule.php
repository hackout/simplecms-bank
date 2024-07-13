<?php
namespace SimpleCMS\Bank\Validation\Rule;

use Illuminate\Contracts\Validation\Rule;
use SimpleCMS\Bank\Validation\BankCard;

/**
 * 银行卡号
 *
 * @author Dennis Lui <hackout@vip.qq.com>
 */
class BankCardRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (!$this->passes($attribute, $value)) {
            $fail($this->message());
        }
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
        return (new BankCard($value))->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'The :attribute is incorrect.';
    }
}