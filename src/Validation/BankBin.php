<?php
namespace SimpleCMS\Bank\Validation;


/**
 * 检查银行BIN
 */
class BankBin
{
    protected string $bin;

    public function __construct(string $bin)
    {
        $this->setBin($bin);
    }

    public function getBin()
    {
        return (string) $this->bin;
    }

    public function setBin(string $bin)
    {
        $this->bin = (string) trim($bin);
    }

    public function isValid(): bool
    {
        return !empty(\SimpleCMS\Bank\Facades\Bank::getBankByBin($this->bin));
    }
}