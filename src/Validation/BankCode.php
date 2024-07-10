<?php
namespace SimpleCMS\Bank\Validation;


/**
 * 检查银行代码
 */
class BankCode
{
    protected string $bank_code;

    public function __construct(string $bank_code)
    {
        $this->setBankCode($bank_code);
    }

    public function getBankCode()
    {
        return (string) $this->bank_code;
    }

    public function setBankCode(string $bank_code)
    {
        $this->bank_code = (string) trim($bank_code);
    }

    public function isValid(): bool
    {
        return !empty(\SimpleCMS\Bank\Facades\Bank::getBankByCode($this->bank_code));
    }
}