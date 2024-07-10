<?php
namespace SimpleCMS\Bank\Validation;


/**
 * 检查银行名称
 */
class Bank
{
    protected string $bank;

    public function __construct(string $bank)
    {
        $this->setBankName($bank);
    }

    public function getBankName()
    {
        return (string) $this->bank;
    }

    public function setBankName(string $bank)
    {
        $this->bank = (string) trim($bank);
    }

    public function isValid(): bool
    {
        return !empty(\SimpleCMS\Bank\Facades\Bank::getBankByName($this->bank));
    }
}