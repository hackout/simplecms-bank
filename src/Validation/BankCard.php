<?php
namespace SimpleCMS\Bank\Validation;


/**
 * 检查银行卡号
 */
class BankCard
{
    protected string $card_number;

    public function __construct(string $card_number)
    {
        $this->setBankName($card_number);
    }

    public function getBankName()
    {
        return (string) $this->card_number;
    }

    public function setBankName(string $card_number)
    {
        $this->card_number = (string) trim($card_number);
    }

    public function isValid(): bool
    {
        return !empty(\SimpleCMS\Bank\Facades\Bank::getBankByCardNumber($this->card_number));
    }
}